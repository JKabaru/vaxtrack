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
  
                                  <form method="POST" action={{ route('update.vaccineType') }} class="forms-sample">
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
                                        <label for="exampleInputUsername1" class="form-label">Recommended age</label>
                                        <input type="text" name="recommended_age" class="form-control @error('recommended_age') is-invalid @enderror"  
                                          
                                        value="{{ $types->recommended_age}}">
                                        @error('recommended_age')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Side effects</label>
                                        <input type="text" name="side_effects" class="form-control @error('side_effects') is-invalid @enderror"  
                                          
                                        value="{{ $types->side_effects}}">
                                        @error('side_effects')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Vaccine icon</label>
                                        <input type="text" name="vaccine_icon" class="form-control @error('vaccine_icon') is-invalid @enderror"  
                                          
                                        value="{{ $types->vaccine_icon}}">
                                        @error('vaccine_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
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