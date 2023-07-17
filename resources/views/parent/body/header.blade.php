<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
  <div class="input-group-text">
    <i data-feather="search"></i>
  </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form>
        <ul class="navbar-nav">
          
          
         
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i data-feather="bell"></i>
                <div class="indicator">
                    <div class="circle"></div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="notificationDropdown">
                <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                    @if($notificationCount > 0)
                        <p>{{ $notificationCount }} New Notifications</p>
                        <a href="{{ route('parentmarkAllred') }}" class="btn btn-danger btn-sm">Mark As Read</a>
                        <a href="{{ route('parentnotifications.index') }}">View all</a>
                    @else
                        <p>No New Notifications</p>
                    @endif
                    
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>
                                        <i class="icon-sm text-primary" data-feather="gift"></i>
                                    </td>
                                    <td>
                                        <p>{{ $notification->data['title'] }}</p>
                                        <p class="tx-12 text-muted">{{ $notification->created_at->diffForHumans() }}</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('parentmarkasred', $notification->id) }}" class="btn btn-danger btn-sm">Mark As Read</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </li>
        

            @php
                
                $id = Auth::user()->id;
                $profileData = App\Models\User::find($id);



            @endphp


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ? 
                      url('upload/parent_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="{{ (!empty($profileData->photo)) ? 
                              url('upload/parent_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ $profileData->name }}</p>
                            <p class="tx-12 text-muted">{{ $profileData->email }}</p>
                        </div>
                    </div>
    <ul class="list-unstyled p-1">
      <li class="dropdown-item py-2">
        <a href="{{ route('parent.profile')}}" class="text-body ms-0">
          <i class="me-2 icon-md" data-feather="user"></i>
          <span>Profile</span>
        </a>
      </li>
      <li class="dropdown-item py-2">
        <a href="{{ route('parent.change.password')}}" class="text-body ms-0">
          <i class="me-2 icon-md" data-feather="edit"></i>
          <span>Change Password</span>
        </a>
      </li>
      
      <li class="dropdown-item py-2">
        <a href="{{ route('parent.logout')}}" class="text-body ms-0">
          <i class="me-2 icon-md" data-feather="log-out"></i>
          <span>Log Out</span>
        </a>
      </li>
    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>