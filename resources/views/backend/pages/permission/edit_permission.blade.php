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
  
                                  <h6 class="card-title">Edit Permission</h6>
  
                                  <form id="myForm" method="POST" action={{ route('update.permission') }} class="forms-sample">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $permission->id}}">

                                      <div class="mb-3">
                                          <label for="exampleInputUsername1" class="form-label">Permission Name</label>
                                          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  
                                            
                                           value="{{ $permission->name }}">
                                          @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>

                                      <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Group Name</label>
                                        <select id="status" name="group_name" class="form-control">
                                            <option selected="" disabled=""> Select Group </option>
                                            <option   value="users" {{ $permission->group_name == 'users' ? 'selected' : ''}} >Users</option>
                                            <option   value="vaccine" {{ $permission->group_name == 'vaccine' ? 'selected' : ''}}  >Vaccine</option>
                                            <option   value="role" {{ $permission->group_name == 'role' ? 'selected' : ''}} >Role and Permission</option>

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
                    group_name: {
                          required : true,
                      }, 
                      
                  },
                  rules: {
                    name: {
                          required : true,
                      }, 
                      
                  },
                  messages :{
                    name: {
                          required : 'This  should not be empty  ',
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