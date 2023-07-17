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
  
                                  <h6 class="card-title">Edit Infant</h6>
  
                                  <form id="myForm" method="POST" action={{ route('update.infant') }} class="forms-sample">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $infant->id}}">

                                      <div class="mb-3">
                                          <label for="exampleInputUsername1" class="form-label">Infant's SurName</label>
                                          <input type="text" name="last_name" class="form-control @error('name') is-invalid @enderror"  
                                            
                                           value="{{ $infant->last_name }}">
                                          @error('last_name')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>

                                      <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Infant's Other Names</label>
                                        <input type="text" name="other_name" class="form-control @error('name') is-invalid @enderror"  
                                          
                                         value="{{ $infant->other_name }}">
                                        @error('other_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                      <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Gender</label>
                                        <select id="status" name="gender" class="form-control">
                                            <option disabled>Select Gender</option>
                                            <option value="Male" {{ $infant->gender === 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $infant->gender === 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>

                                    

                                    <div class="col">
                                        <label class="form-label">Date of Birth :</label>
                                        <input class="form-control mb-4 mb-md-0" name ="age_group"  value="{{ $infant->age }} " type="" pattern="\d{2}/\d{2}/\d{4}" title="Please enter a valid date in the format dd/mm/yyyy">
                                        <span class="text-warning">Please enter a valid date in the format yyyy/mm/dd </span>
                                    </div>





         


                                    <div class="mb-3">
                                        @php
                                            $parents = App\Models\User::getParentsByRole('parent');
                                        @endphp
                                        <h4><span class="">Registered Parent</span><br></h4>
                                        <label for="exampleInputUsername1" class="form-label"><br>Parent</label>
                                        <select id="parentSelect" name="parent_id" class="form-control">
                                            <option selected value="">Select Parent</option>
                                            @foreach ($parents as $parent)
                                                <option value="{{ $parent->id }}" {{ $parent->id === $infant->parent_id ? 'selected' : '' }}
                                                    data-email="{{ $parent->email }}" data-number="{{ $parent->phone_number }}">{{ $parent->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <h4><span class=""><br>Add Parent details</span><br></h4>
                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label"><br>Parent/Guardian's Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" value="{{ $infant->parent_email }}" class="form-control" name="parent_email" id="parentEmail" autocomplete="off" placeholder="Email">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Parent/Guardian's Mobile Number</label>
                                        <div class="col-sm-9">
                                            <input type="number" value="{{ $infant->parent_phone }}" name="parent_phone" class="form-control" id="parentPhone" placeholder="Mobile number">
                                        </div>
                                    </div>
                                    
                                    <script>
                                        const parentSelect = document.getElementById('parentSelect');
                                        const parentEmailInput = document.getElementById('parentEmail');
                                        const parentPhoneInput = document.getElementById('parentPhone');
                                    
                                        parentSelect.addEventListener('change', () => {
                                            const selectedOption = parentSelect.options[parentSelect.selectedIndex];
                                            const email = selectedOption.getAttribute('data-email');
                                            const number = selectedOption.getAttribute('data-number');
                                    
                                            parentEmailInput.value = email || '';
                                            parentPhoneInput.value = number || '';
                                        });
                                    
                                        // Trigger the change event initially if a parent is already selected
                                        if (parentSelect.value !== '') {
                                            parentSelect.dispatchEvent(new Event('change'));
                                        }
                                    </script>
                                    
                                    


                                    
                                    




                                    {{-- <div class="mb-3">
                                        @php
                                            $vaccines = App\Models\VaccineType::getAllVaccines();
                                        @endphp
                                    
                                        <label for="exampleInputUsername1" class="form-label">Vaccine</label>
                                        <select id="status" name="vaccine_id" class="form-control">
                                            <option disabled>Select Vaccine</option>
                                            @foreach ($vaccines as $vaccine)
                                                <option value="{{ $vaccine->id }}" {{ $vaccine->id === $infant->vaccine_id ? 'selected' : '' }}>
                                                    {{ $vaccine->name }} - Dose {{ $vaccine->dose_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    


                                      

                                    


                                      

                  

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
                    name: {
                          required : true,
                      }, 

                      gender: {
                          required : true,
                      }, 

                      age_group: {
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