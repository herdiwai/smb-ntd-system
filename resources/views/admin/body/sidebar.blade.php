<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        BTM-<span style="color: orange">SYSTEM</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        {{-- @if(Auth::user()->can('pullstrength.menu')) --}}
        @if(Auth::user()->can('hourlyoutput.menu'))

          <li class="nav-item nav-category">PRODUCTION</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
              <i class="link-icon" data-feather="clipboard"></i>
              <span class="link-title">Hourly Output</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="emails">
              <ul class="nav sub-menu">

                @if(Auth::user()->can('hourlyoutput.all'))
                  <li class="nav-item">
                    <a href="{{ route('production.hourlyoutput') }}" class="nav-link">All Table</a>
                  </li>
                @endif

                @if(Auth::user()->can('hourlyoutput.Add'))
                  <li class="nav-item">
                    <a href="{{ route('add.hourlyoutput') }}" class="nav-link">Add</a>
                  </li>
                @endif

                  <li class="nav-item">
                    <a href="{{ route('process.model') }}" class="nav-link">All Table Procces Model</a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('add.processmodel') }}" class="nav-link">Add Procces Model</a>
                  </li>
                
                {{-- <li class="nav-item">
                  <a href="pages/email/compose.html" class="nav-link">Compose</a>
                </li> --}}
              </ul>
            </div>
          </li>

        @endif


        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#emails2" role="button" aria-expanded="false" aria-controls="emails2">
            <i class="link-icon" data-feather="clipboard"></i>
            <span class="link-title">MRR Request</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="emails2">
            <ul class="nav sub-menu">

                <li class="nav-item">
                  <a href="{{ route('production.mrr') }}" class="nav-link">All Table</a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('add.mrr') }}" class="nav-link">Add</a>
                </li>

            </ul>
          </div>
        </li>




        {{-- @endif --}}
        {{-- <li class="nav-item">
          <a href="pages/apps/calendar.html" class="nav-link">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Calendar</span>
          </a>
        </li> --}}

        {{-- @if(Auth::user()->can('pullstrength.menu')) --}}
          <li class="nav-item nav-category">Quality Control</li>
          {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Pull Strength Test</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents">
              <ul class="nav sub-menu">
                @if(Auth::user()->can('all.pullstrength'))
                <li class="nav-item">
                  <a href="pages/ui-components/accordion.html" class="nav-link">All Table</a>
                </li>
                @endif
                @if(Auth::user()->can('add.pullstrength'))
                <li class="nav-item">
                  <a href="pages/ui-components/alerts.html" class="nav-link">Add</a>
                </li>
                @endif
              </ul>
            </div>
          </li>
          @endif --}}


        @if(Auth::user()->can('testingrequisition.menu'))
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents1" role="button" aria-expanded="false" aria-controls="uiComponents1">
                <i class="link-icon" data-feather="file"></i>
                <span class="link-title" style="font-size: 12.5px;">Sample Testing Requisition</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="uiComponents1">
                <ul class="nav sub-menu">
                  
                  <li class="nav-item">
                    <a href="{{ route('qualitycontrol.sampletestingrequisition') }}" class="nav-link">All Table</a>
                  </li>
                
                  @if(Auth::user()->can('add.testingrequisition'))
                  <li class="nav-item">
                    <a href="{{ route('add.sampletestingrequisition') }}" class="nav-link">Add</a>
                  </li>
                  @endif

                  @if(Auth::user()->can('all.filterSample'))
                  <li class="nav-item">
                    <a href="{{ route('filter.sample') }}" class="nav-link">Filter Sample</a>
                  </li>
                  @endif

                </ul>
              </div>
            </li>
          @endif

          @if(Auth::user()->can('testingreport.menu'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents01" role="button" aria-expanded="false" aria-controls="uiComponents01">
              <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">Requisition & Report</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents01">
              <ul class="nav sub-menu">
                
                @if(Auth::user()->can('all.testingreport'))
                <li class="nav-item">
                  <a href="{{ route('qualitycontrol.sampletestingreport') }}" class="nav-link">All Table</a>
                </li>
                @endif

                @if(Auth::user()->can('all.filterSample'))
                <li class="nav-item">
                  <a href="{{ route('filter.sample') }}" class="nav-link">Filter Sample</a>
                </li>
                @endif
               
                {{-- <li class="nav-item">
                  <a href="" class="nav-link">Add</a>
                </li> --}}
             
              </ul>
            </div>
          </li>
          @endif


          {{-- @if(Auth::user()->can('approved.menu'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents02" role="button" aria-expanded="false" aria-controls="uiComponents02">
              <i class="link-icon" data-feather="folder"></i>
              <span class="link-title">Approved</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents02">
              <ul class="nav sub-menu">
                
                <li class="nav-item">
                  <a href="{{ route('approval.status') }}" class="nav-link">All Table</a>
                </li>
        
              </ul>
            </div>
          </li>
          @endif --}}

         
          @if(Auth::user()->can('notyetappovals.menu'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents04" role="button" aria-expanded="false" aria-controls="uiComponents04">
              <i class="link-icon" data-feather="folder"></i>
              <span class="link-title" style="font-size: 12.5px;">Requisitiion & Report</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents04">
              <ul class="nav sub-menu">
                
                @if(Auth::user()->can('all.testingreport'))
                <li class="nav-item">
                  <a href="{{ route('qualitycontrol.sampletestingrequisition') }}" class="nav-link">All Table</a>
                </li>
               @endif

               @if(Auth::user()->can('all.filterSample'))
                <li class="nav-item">
                  <a href="{{ route('filter.sample') }}" class="nav-link">Filter Sample</a>
                </li>
              @endif

              </ul>
            </div>
          </li>
          @endif

          @if(Auth::user()->can('approvalsspv.menu'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents05" role="button" aria-expanded="false" aria-controls="uiComponents05">
              <i class="link-icon" data-feather="folder"></i>
              <span class="link-title">Requisition & Report</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents05">
              <ul class="nav sub-menu">
                
                @if(Auth::user()->can('all.approvalsspv'))
                <li class="nav-item">
                  <a href="{{ route('qualitycontrol.sampletestingrequisition') }}" class="nav-link">All Table</a>
                </li>
               @endif

               @if(Auth::user()->can('all.filterSample'))
                <li class="nav-item">
                  <a href="{{ route('filter.sample') }}" class="nav-link">Filter Sample</a>
                </li>
              @endif

              </ul>
            </div>
          </li>
          @endif

          {{-- Menu Approvals QE --}}
          @if(Auth::user()->can('menu.approvalsQE'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents06" role="button" aria-expanded="false" aria-controls="uiComponents06">
              <i class="link-icon" data-feather="folder"></i>
              <span class="link-title" style="font-size: 13.5px;">Requisition & Report</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents06">
              <ul class="nav sub-menu">
                
                @if(Auth::user()->can('all.approvalsQE'))
                <li class="nav-item">
                  <a href="{{ route('qualitycontrol.sampletestingrequisition') }}" class="nav-link">All Table</a>
                </li>
                @endif

                @if(Auth::user()->can('all.filterSample'))
                <li class="nav-item">
                  <a href="{{ route('filter.sample') }}" class="nav-link">Filter Sample</a>
                </li>
                @endif
             
              </ul>
            </div>
          </li>
          @endif
          {{-- End Approvals QE --}}


          {{-- Menu SubAssy Patrol --}}
          @if(Auth::user()->can('testingrequisition.menu'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents07" role="button" aria-expanded="false" aria-controls="uiComponents07">
              <i class="link-icon" data-feather="file"></i>
              <span class="link-title" style="font-size: 13.5px;">SubAssy Patrol</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents07">
              <ul class="nav sub-menu">
                
                @if(Auth::user()->can('add.testingrequisition'))
                <li class="nav-item">
                  <a href="{{ route('qualitycontrol.subassypatrolrecord') }}" class="nav-link">All Table</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('add.ProcessPatrol') }}" class="nav-link">Add</a>
                </li>
                @endif
             
              </ul> 
            </div>
          </li>
          @endif
          {{-- End SubAssy Patrol --}}





          {{-- Menu Filter Sample Requisition and Report --}}
          {{-- @if(Auth::user()->can('menu.filterSample'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents07" role="button" aria-expanded="false" aria-controls="uiComponents07">
              <i class="link-icon" data-feather="filter"></i>
              <span class="link-title">Filter Sample</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents07">
              <ul class="nav sub-menu">
                
                @if(Auth::user()->can('all.filterSample'))
                <li class="nav-item">
                  <a href="{{ route('filter.sample') }}" class="nav-link">All Table</a>
                </li>
                @endif
             
              </ul>
            </div>
          </li>
          @endif --}}
          {{-- End Approvals QE --}}

         

          @if(Auth::user()->can('Sparepart.menu'))
        <li class="nav-item nav-category">Facility</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
            <i class="link-icon" data-feather="feather"></i>
            <span class="link-title">Spare part</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="uiComponents">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="pages/ui-components/accordion.html" class="nav-link">All Table</a>
              </li>
              <li class="nav-item">
                <a href="pages/ui-components/alerts.html" class="nav-link">Add</a>
              </li>
            </ul>
          </div>
        </li>
        @endif

        @if(Auth::user()->can('maintenance.menu'))
          <li class="nav-item nav-category">Maintenance</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Spare part</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="pages/ui-components/accordion.html" class="nav-link">All Table</a>
                </li>
                <li class="nav-item">
                  <a href="pages/ui-components/alerts.html" class="nav-link">Add</a>
                </li>
              </ul>
            </div>
          </li>
        @endif
        
        @if(Auth::user()->can('model.menu'))
          <li class="nav-item nav-category">List</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents2" role="button" aria-expanded="false" aria-controls="uiComponents2">
              <i class="link-icon" data-feather="table"></i>
              <span class="link-title">Model</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents2">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('model.brewer') }}" class="nav-link">All Table</a>
                </li>
                <li class="nav-item">
                  <a href="pages/ui-components/alerts.html" class="nav-link">Add</a>
                </li>
              </ul>
            </div>
          </li>
        @endif

        @if(Auth::user()->can('process.menu'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents3" role="button" aria-expanded="false" aria-controls="uiComponents3">
              <i class="link-icon" data-feather="table"></i>
              <span class="link-title">Process</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents3">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('process.all') }}" class="nav-link">All Table</a>
                </li>
                <li class="nav-item">
                  <a href="pages/ui-components/alerts.html" class="nav-link">Add</a>
                </li>
              </ul>
            </div>
          </li>
          @endif

          @if(Auth::user()->can('lot.menu'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents4" role="button" aria-expanded="false" aria-controls="uiComponents4">
              <i class="link-icon" data-feather="table"></i>
              <span class="link-title">Lot</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents4">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('lot.all') }}" class="nav-link">All Table</a>
                </li>
                <li class="nav-item">
                  <a href="pages/ui-components/alerts.html" class="nav-link">Add</a>
                </li>
              </ul>
            </div>
          </li>
          @endif


        @if(Auth::user()->can('role&permission.menu'))

          <li class="nav-item nav-category">Role & Permission</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
              <i class="link-icon" data-feather="anchor"></i>
              <span class="link-title">Role & Permission</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="advancedUI">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('all.permission') }}" class="nav-link">All Permission</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('all.roles') }}" class="nav-link">All Roles</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('add.roles.permission') }}" class="nav-link">Role In Permission</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('all.roles.permission') }}" class="nav-link">All Role In Permission</a>
                </li>
              </ul>
            </div>
          </li>

        @endif

        @if(Auth::user()->can('manageadminuser.menu'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button" aria-expanded="false" aria-controls="admin">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">Manage Admin User</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="admin">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('all.admin') }}" class="nav-link">All Admin</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('add.admin') }}" class="nav-link">Add Admin</a>
                </li>
              </ul>
            </div>
          </li>
        @endif
        {{-- @endif --}}
{{--         
        <li class="nav-item">
          <a href="#" target="_blank" class="nav-link">
            <i class="link-icon" data-feather="hash"></i>
            <span class="link-title">Documentation</span>
          </a>
        </li> --}}
      </ul>
    </div>
  </nav>