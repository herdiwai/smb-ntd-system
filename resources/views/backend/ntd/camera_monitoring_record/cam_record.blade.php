@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <style>
        .container {
            background: rgb(17, 17, 17);
            width: 100vw; /* Lebar penuh */
            height: 130vw; /* Tinggi penuh */
            margin: 0;
            padding: 20px;
            border-radius: 0; /* Hapus border-radius agar full */
            box-shadow: none; /* Hapus shadow jika tidak perlu */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Pusatkan secara vertikal */
            align-items: center; /* Pusatkan secara horizontal */
        }

        video {
            width: 100%;
            max-width: 100vw;
            border-radius: 10px;
            border: 2px solid #ddd;
            margin-bottom: 10px;
        }

        timestamp {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: rgb(230, 74, 13);
            padding: 5px 10px;
            font-size: 50px;
            border-radius: 5px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        button:hover:not(:disabled) {
            background-color: #218838;
        }

        #download {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background 0.3s;
        }

        #download:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container">
        <h2>Live Webcam</h2>
        <div id="timestamp">00:00:00</div>
        <video id="webcam" autoplay></video>

        <div class="buttons">
            
            <button id="start">Start Recording</button>
            <button id="stop" disabled>Stop Recording</button>
        </div>

        <h2>Recorded Video</h2>
        <video id="recordedVideo" controls>
            <source id="recordedVideoSource" type="video/mp4">
        </video>
        <a id="download" download="recorded-video.mp4" style="display:none;">Download Video</a>
    </div>

    <script>
        const webcam = document.getElementById('webcam');
        const recordedVideo = document.getElementById('recordedVideo');
        const startButton = document.getElementById('start');
        const stopButton = document.getElementById('stop');
        const downloadLink = document.getElementById('download');
        const timestamp = document.getElementById('timestamp');
        const seekButton = document.getElementById('seekButton');
        const seekTimeInput = document.getElementById('seekTime');
    
        let mediaRecorder;
        let recordedChunks = [];
    
        // Durasi perekaman otomatis setiap 24 jam (24 * 60 * 60 * 1000 ms)
        const autoSaveInterval = 86400000;  
    
        navigator.mediaDevices.getUserMedia({ video: true, audio: true })
            .then(stream => {
                webcam.srcObject = stream;
                mediaRecorder = new MediaRecorder(stream);
    
                mediaRecorder.ondataavailable = event => {
                    if (event.data.size > 0) {
                        recordedChunks.push(event.data);
                    }
                };
    
                mediaRecorder.onstop = () => {
                    console.log("Perekaman dihentikan, menyiapkan video untuk disimpan...");
                    const blob = new Blob(recordedChunks, { type: 'video/webm' });
                    recordedChunks = [];

                    const videoURL = URL.createObjectURL(blob);
                    recordedVideo.src = videoURL;
                    downloadLink.href = videoURL;
                    downloadLink.download = `recorded-${Date.now()}.webm`;
                    downloadLink.style.display = 'block';

                    // Upload video ke server setelah perekaman berhenti
                    uploadVideo(blob);
                };
            })
            .catch(error => {
                console.error("Gagal mengakses kamera:", error);
                alert("Gagal mengakses kamera. Periksa izin atau perangkat Anda.");
            });
    
        startButton.onclick = () => {
            startRecording();
        };
    
        stopButton.onclick = () => {
            console.log("Perekaman dihentikan secara manual.");
            mediaRecorder.stop();
            startButton.disabled = false;
            stopButton.disabled = true;
        };
    
        // Fungsi untuk memulai perekaman
        function startRecording() {
            mediaRecorder.start();
            startButton.disabled = true;
            stopButton.disabled = false;
    
            console.log("Perekaman dimulai...");
    
            // Timer autosave setiap 24 jam
            setTimeout(() => {
                console.log("24 jam selesai, menghentikan perekaman dan menyimpan...");
                mediaRecorder.stop();
                
                // Tunggu beberapa detik sebelum memulai perekaman ulang
                setTimeout(startRecording, 5000);
            }, autoSaveInterval);
        }
    
        // Fungsi untuk menyimpan dan mengunggah video
        function uploadVideo(blob) {
            let formData = new FormData();
            formData.append('video', blob, 'recorded-video.webm');
            
            fetch("{{ route('video.record') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.path) {
                    // Update video player source to the new MP4 video path
                    recordedVideo.src = data.path;
                    downloadLink.href = data.path;
                    downloadLink.download = data.path.split('/').pop(); // Extract file name for download
                    downloadLink.style.display = 'block';
                } else {
                    alert("Gagal menyimpan video!");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    
        // Fungsi menampilkan waktu real-time (CCTV timestamp)
        function updateTimestamp() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const formattedTime = `${hours}:${minutes}:${seconds}`;
            timestamp.innerText = formattedTime;
        }
    
        // Update timestamp setiap detik
        setInterval(updateTimestamp, 1000);
    
        // Fungsi untuk melompat ke waktu tertentu dalam video
        seekButton.addEventListener("click", () => {
            const seekTime = parseInt(seekTimeInput.value, 10);
            
            if (!isNaN(seekTime) && seekTime >= 0 && seekTime <= recordedVideo.duration) {
                recordedVideo.currentTime = seekTime;
            } else {
                alert("Masukkan waktu yang valid!");
            }
        });
    </script>
</div>
@endsection