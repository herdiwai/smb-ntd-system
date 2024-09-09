<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        BTM-<span>System</span>
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
              <i class="link-icon" data-feather="mail"></i>
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
                {{-- <li class="nav-item">
                  <a href="pages/email/compose.html" class="nav-link">Compose</a>
                </li> --}}
              </ul>
            </div>
          </li>

        @endif
        {{-- @endif --}}
        {{-- <li class="nav-item">
          <a href="pages/apps/calendar.html" class="nav-link">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Calendar</span>
          </a>
        </li> --}}

        @if(Auth::user()->can('pullstrength.menu'))
          <li class="nav-item nav-category">Quality Control</li>
          <li class="nav-item">
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
          @endif

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
        {{-- @if(Auth::user()->can('')) --}}

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
              <i class="link-icon" data-feather="anchor"></i>
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