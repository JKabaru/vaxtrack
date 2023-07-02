

<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
  <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
          Vax<span>Track</span>
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
          <li class="nav-item nav-category">Vaccines</li>
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#vaccines" role="button"
                  aria-expanded="false" aria-controls="vaccines">
                  <i class="link-icon" data-feather="medicine"></i>
                  <span class="link-title">Vaccines</span>
                  <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="vaccines">
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
                  </ul>
              </div>
          </li>
          <li class="nav-item nav-category">Components</li>
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button"
                  aria-expanded="false" aria-controls="uiComponents">
                  <i class="link-icon" data-feather="feather"></i>
                  <span class="link-title">UI Kit</span>
                  <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="uiComponents">
                  <ul class="nav sub-menu">
                      <li class="nav-item">
                          <a href="pages/ui-components/accordion.html" class="nav-link">Accordion</a>
                      </li>
                      <li class="nav-item">
                          <a href="pages/ui-components/alerts.html" class="nav-link">Alerts</a>
                      </li>
                  </ul>
              </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button"
                  aria-expanded="false" aria-controls="advancedUI">
                  <i class="link-icon" data-feather="anchor"></i>
                  <span class="link-title">Advanced UI</span>
                  <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="advancedUI">
                  <ul class="nav sub-menu">
                      <li class="nav-item">
                          <a href="pages/advanced-ui/cropper.html" class="nav-link">Cropper</a>
                      </li>
                      <li class="nav-item">
                          <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Owl carousel</a>
                      </li>
                  </ul>
              </div>
          </li>
          <li class="nav-item nav-category">Docs</li>
          <li class="nav-item">
              <a href="#" target="_blank" class="nav-link">
                  <i class="link-icon" data-feather="hash"></i>
                  <span class="link-title">Documentation</span>
              </a>
          </li>
      </ul>
  </div>
</nav>
