<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
  <meta name="author" content="NobleUI">
  <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
  <title>VaxTrack</title>

  
  <style type="text/css">

    .authregister-side-wrapper
    {
        width:100%;
        height: 100%;
        background-image: url({{asset('upload/register.jpg')}});
    }


</style>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->
  <!-- core:css -->
  <link rel="stylesheet" href="../../../assets/vendors/core/core.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../../assets/fonts/feather-font/css/iconfont.css">
  <link rel="stylesheet" href="../../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../../../assets/css/demo2/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../../../assets/images/favicon.png" />
</head>
<body>
  <div class="main-wrapper">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
          <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
              <div class="row">
                <div class="col-md-4 pe-md-0">


                  <div class="authregister-side-wrapper">
                    <!-- Add your image holder here -->
                  </div>
                
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">Vax<span>Track</span></a>
                    <h5 class="text-muted fw-normal mb-4">Create a free account.</h5>

                    <form class="forms-sample" method="POST" action="{{ route('register') }}">
                        @csrf

                      <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"  placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        
                                   @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               
                                    @enderror
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">


                               @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                      </div>

                      <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password" placeholder="Password">


                        <ul>
                            <li class="text-danger">
                                <small class="text-danger">Your password should have at least 8 characters.</small>
                            </li>
                        </ul>       


                      </div>

                      <div class="mb-3">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password-confirm" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                      </div>
                      <div class="form-check mb-3">
                        
                      </div>
                      <div>

                        <button type="submit" class="btn btn-primary text-white me-2 mb-2 mb-md-0">Sign up</button>
                        
                         
                        
                      </div>
                      <a href="{{ route('admin.login') }}" class="d-block mt-3 text-muted">Already a user? Sign in</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- core:js -->
  <script src="../../../assets/vendors/core/core.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../../assets/vendors/feather-icons/feather.min.js"></script>
  <script src="../../../assets/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
</body>
</html>
