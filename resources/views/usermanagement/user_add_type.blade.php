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
  
                                  <h6 class="card-title">Add User</h6>
  
                                  <form id="myForm" method="POST" action={{ route('store.userType') }} class="forms-sample">
                                    @csrf

                                      <div class="mb-3">
                                          <label for="exampleInputUsername1" class="form-label">Name</label>
                                          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  
                                            
                                           >
                                          @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>

                                      <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"  
                                          
                                         >
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    

                                    <div class="form-group mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  
                                          
                                        id="password" autocomplete="off" >
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Role</label>
                                        <select id="role" name="role" class="form-control">
                                            <option value="user" >User</option>
                                            <option value="parent" >Parent</option>
                                            <option value="admin" >Admin</option>
                                            <option value="doctor" >Doctor</option>
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


        <script type="text/javascript">
          $(document).ready(function (){
              $('#myForm').validate({
                  rules: {
                    password: {
                          required : true,
                      }, 
                      
                  },
                  messages :{
                    password: {
                          required : 'Password should be more than  8 characters  ',
                      }, 
                       
      
                  },
                  errorElement : 'span', 
                  errorPlacement: function (error,element) {
                      error.addClass('invalid-feedback');
                      element.closest('.form-group').append(error);
                  },
                  highlight : function(element, errorClass, validClass){
                      $(element).addClass('is-invalid');
                  },
                  unhighlight : function(element, errorClass, validClass){
                      $(element).removeClass('is-invalid');
                  },
              });
          });
          
      </script>



@endsection