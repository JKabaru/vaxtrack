<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Vax<span>Track</span>
        </a>
        <div class="sidebar-toggler">
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

            {{-- reports --}}

            <li class="nav-item nav-category">Reports and Analytics</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#reports" role="button"
                    aria-expanded="false" aria-controls="reports">
                    <i class="link-icon" data-feather="heart"></i>
                    <span class="link-title">Reports</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="reports">
                    <ul class="nav sub-menu">
                        <li class="nav-item"> 
                            <a href="{{ route('vaccination-completion-rates') }}" class="nav-link">Vaccination Completion Rates</a></li>
                            <li class="nav-item"><a href="{{ route('completion-rate-by-age') }}" class="nav-link">Completion Rates by Infant Age</a></li>

                       
                        <li class="nav-item"><a href="{{ route('parent-doctor-analysis') }}" class="nav-link">Parent  Analysis</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Vaccines</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#vaccineTypes" role="button"
                    aria-expanded="false" aria-controls="vaccineTypes">
                    <i class="link-icon" data-feather="heart"></i>
                    <span class="link-title">Vaccines</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="vaccineTypes">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.type') }}" class="nav-link">All Vaccines</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.type') }}" class="nav-link">Add Vaccines</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Users --}}
            <li class="nav-item nav-category">Users</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#userDetails" role="button"
                    aria-expanded="false" aria-controls="userDetails">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">User Details</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="userDetails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('userall.type') }}" class="nav-link">All Users</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('useradd.type') }}" class="nav-link">Add User</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('useractivation.type') }}" class="nav-link">Disabled Users</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Roles and permission --}}
            {{-- <li class="nav-item nav-category">Roles & Permissions</li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#roleDetails" role="button"
                    aria-expanded="false" aria-controls="roleDetails">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Roles & Permissions</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="roleDetails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.permission') }}" class="nav-link">All Permissions</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all.roles') }}" class="nav-link">All Roles</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.roles.permission') }}" class="nav-link">Role in Permission</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all.roles.permission') }}" class="nav-link">All Roles in Permission</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            {{-- Infants and schedule --}}
            <li class="nav-item nav-category">Infants & Vaccine Schedule</li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#infantDetails" role="button"
                    aria-expanded="false" aria-controls="infantDetails">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Infants & Vaccine Schedule</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="infantDetails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.infants') }}" class="nav-link">All Infants</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all.infants.vaccines') }}" class="nav-link">Schedule Vaccines </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.infantVaccinations') }}" class="nav-link">All Infants' Vaccines Scheduled</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
