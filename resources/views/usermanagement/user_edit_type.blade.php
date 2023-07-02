@extends('admin.admin_dashboard')
@section('admin')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   


<div class="page-content">

    
    <div class="row profile-body">
      <!-- left wrapper start -->
      
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
  
                                  <h6 class="card-title">Edit</h6>
  
                                  <form method="POST" action={{ route('update.userType') }} class="forms-sample">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $types->id }}">


                                      <div class="mb-3">
                                          <label for="exampleInputUsername1" class="form-label">Name</label>
                                          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  
                                            
                                           value="{{ $types->name}}">
                                          @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>

                                      <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"  
                                          
                                        value="{{ $types->email}}">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Status</label>
                                        <select id="role" name="role" class="form-control">
                                            <option value="Active" @if ($types->status === 'Active' || $types->status === 'active') selected @endif>Active</option>
                                            <option   value="Pending" @if ($types->status === 'pending' || $types->status === 'Pending') selected @endif>Pending</option>
                                            <option value="Disabled" @if ($types->status === 'disabled' || $types->status === 'Disabled') selected @endif>Disabled</option>
                                        </select>
                                    </div>

                                    

                                    


                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Role</label>
                                        <select id="role" name="role" class="form-control">
                                            <option value="user" @if ($types->role === 'user') selected @endif>User</option>
                                            <option value="parent" @if ($types->role === 'parent') selected @endif>Parent</option>
                                            <option value="admin" @if ($types->role === 'admin') selected @endif>Admin</option>
                                            <option value="doctor" @if ($types->role === 'doctor') selected @endif>Doctor</option>
                                        </select>
                                    </div>



                                    
                                    

                                    


                                      

                  

                                      <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                  </form>
  
                </div>
              </div>
          
        </div>
      </div>
      <!-- middle wrapper end -->
      <!-- right wrapper start -->
      
      <!-- right wrapper end -->
    </div>

        </div>






@endsection