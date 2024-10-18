@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
    <h2>Review and Approval Form</h2>

    {{-- @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif --}}
    {{-- {{ route('review.submit', $review->id) }} --}}
    <form action="" method="POST">
        @csrf

        <div class="form-group">
            <label for="status">Approval Status</label>
            <select name="status" class="form-control" required>
                {{-- {{ $review->status == 'approved' ? 'selected' : '' }}
                {{ $review->status == 'rejected' ? 'selected' : '' }} --}}
                <option value="approved" >Approved</option>
                <option value="rejected" >Rejected</option>
            </select>
        </div>

        <div class="form-group">
            <label for="notes">Manager's Notes</label>
            {{-- {{ old('notes', $review->notes) }} --}}
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <!-- Tambah input dinamis untuk komentar tambahan -->
        <div class="form-group">
            <label for="additional_comments">Additional Comments</label>
            <div id="dynamic-comments">
                <input type="text" name="additional_comments[]" class="form-control mb-2">
            </div>
            <button type="button" id="add-comment" class="btn btn-secondary">Add Comment</button>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
</div>
</div>
</div>

<script>
    // Script untuk menambah komentar tambahan secara dinamis
    document.getElementById('add-comment').addEventListener('click', function() {
        var commentDiv = document.createElement('div');
        commentDiv.classList.add('mb-2');
        commentDiv.innerHTML = '<input type="text" name="additional_comments[]" class="form-control">';
        document.getElementById('dynamic-comments').appendChild(commentDiv);
    });
</script>
@endsection
