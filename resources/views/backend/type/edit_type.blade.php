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
                                        <label for="exampleInputUsername1" class="form-label">Age Groups</label>
                                        <select id="status" name="recommended_age" class="form-control">
                                            <option selected disabled>Select Age group</option>
                                            @foreach ($ageranges as $agerange)
                                                <option value="{{ $agerange->id }}" {{ $agerange->id === $types->age_range_id ? 'selected' : '' }}>
                                                    {{ $agerange->StartAge }} months - {{ $agerange->EndAge }} months
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    


                                    <div class="mb-3">
                                      <label for="exampleInputUsername1" class="form-label">Dose number</label>
                                      <input type="text" name="dose_number" class="form-control @error('dose_number') is-invalid @enderror"  
                                        
                                      value="{{ $types->dose_number}}">
                                      @error('dose_number')
                                      <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>

                                  <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">Description</label>
                                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"  
                                      
                                    value="{{ $types->description}}">
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                  <label for="exampleInputUsername1" class="form-label">Side Effects </label>
                                  <input type="text" name="side_effects" class="form-control @error('side_effects') is-invalid @enderror"  
                                    
                                  value="{{ $types->side_effects}}">
                                  @error('side_effects')
                                  <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>

                              <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Storage Requirements </label>
                                <input type="text" name="storage_requirements" class="form-control @error('storage_requirements') is-invalid @enderror"  
                                  
                                value="{{ $types->storage_requirements}}">
                                @error('storage_requirements')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                                   
                                  <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">Country</label>
                                    <select id="status" name="country" class="form-control">
                                        <option selected disabled>Select the Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" {{ $country->id === $types->country_id ? 'selected' : '' }}>
                                                {{ $country->CountryName }} 
                                            </option>
                                        @endforeach
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