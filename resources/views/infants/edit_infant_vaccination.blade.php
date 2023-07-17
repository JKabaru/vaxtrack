@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <h1>{{$infants->name}}</h1>
        </ol>
        
    </nav>
   

@php
    $birthdate = \Carbon\Carbon::createFromDate($infants->age); // Replace with the actual birthdate
                    $currentDate = \Carbon\Carbon::today();

                        $age = $currentDate->diffInMonths($birthdate);
    $ageRange = App\Models\AgeRange::where('StartAge', '<=', $age)
                                  ->where('EndAge', '>=', $age)
                                  ->first();
@endphp
<h1>{{$infants->last_name}} {{$infants->other_name}}</h1><br>
<h2>Age Range: {{ $ageRange->StartAge }} months - {{ $ageRange->EndAge }} months</h2><br>
<h3>Description: {{ $ageRange->Description }}</h3><br>
    

    {{-- <div class="mb-3">
        <label for="exampleInputUsername1" class="form-label">Age Group</label>
        <select id="status" name="age_group" class="form-control">
            <option value="0" {{ $infants->age === 0 ? 'selected' : '' }}>Birth</option>
            <option value="2" {{ $infants->age === 2 ? 'selected' : '' }}>2 months</option>
            <option value="4" {{ $infants->age === 4 ? 'selected' : '' }}>4 months</option>
            <option value="6" {{ $infants->age === 6 ? 'selected' : '' }}>6 months</option>
            <option value="9" {{ $infants->age === 9 ? 'selected' : '' }}>9 months</option>
            <option value="12" {{ $infants->age === 12 ? 'selected' : '' }}>12 months</option>
        
        </select>
    </div> --}}


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{$infants->name}} Vaccines details</h6><br>
                                            <!-- Display the bulk update button -->

               

                    <div class="table-responsive">

                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    
                                    <th>Vaccine</th>
                                    
                                    <th>Dosage</th>
                                    <th>Status</th>
                                    <th>Administration Date</th>
                                    <th>Next Due Date </th>
                                    <th>Send a reminder </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                
                                $vaccines = App\Models\VaccineType::with('ageRange')->get()->groupBy('age_range_id');
                                @endphp
                                @foreach($vaccines as $recommendedAge => $groupedVaccines)
                                                @foreach($groupedVaccines as $vaccine)
                                                    

                                                @php
                                                $infantVaccine = $infantvaccines->where('vaccine_id', $vaccine->id)->where('infant_id', $infants->id)->first();
                                                $ageMonths = $recommendedAge; // Assign the recommended age to $ageMonths
                                                $currentDate = now();
                                                //    $administrationDate = $currentDate->addMonths($ageMonths)->format('Y-m-d'); // Calculate administration date and format it as YYYY-MM-DD
                                                // if ($infants->age === $recommendedAge) {
                                                //         $administrationDate = $currentDate->format('Y-m-d'); // Set administration date to now
                                                //     } else {
                                                //         $administrationDate = $currentDate->addMonths($ageMonths - $infants->age)->format('Y-m-d'); // Calculate administration date and format it as YYYY-MM-DD
                                                //     }
                                            
                                            
                                            @endphp


                                                    @if ($infantVaccine)
                                                        <tr>
                                                            
                                                            

                                                            <td>
                                                                <span class="badge bg-danger">{{ $vaccine->name }}</span>
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $vaccine->dose_number}} <br> {{ $vaccine->description}}
                                                            </td>
                                                            @php
                                                            $birthdate = \Carbon\Carbon::createFromDate($infants->age); // Replace with the actual birthdate
                                                                    $currentDate = \Carbon\Carbon::today();

                                                                        $age2 = $currentDate->diffInMonths($birthdate);
                                                            $ageRangeId = $vaccine->age_range_id; // Access the age range ID

                                                                $ageRange2 = App\Models\AgeRange::find($ageRangeId); // Retrieve the age range based on the ID
                                                                
                                                                if ($ageRange2->StartAge <= $ageRange->StartAge ) {
                                                                    $nextDueDate = $currentDate->format('Y-m-d');
                                                                    }
                                                                    else {
                                                                       
                                                                        $nextDueDate = $currentDate->addMonths($ageRange2->StartAge - $age2)->format('Y-m-d'); // Calculate the next due date based on the start age of the age range
                                                                    }

                                                        @endphp
                                                                <form action="{{ route('update.infantvaccinations') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $infantVaccine->id}}">
                                                                    

                                                                    <input type="hidden" name="next_due_date" value="{{  $nextDueDate }}">

                                                                    <td><div class="form-check">
                                                                        <input class="form-check-input" name ="completed_field" type="checkbox" id="vaccine-{{ $infantVaccine->id }}" {{ $infantVaccine->completed ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="vaccine-{{ $infantVaccine->id }}">
                                                                            Completed
                                                                        </label>
                                                                    </div></td>
                                                                    <td>
                                                                        <p><span class="badge bg-warning">{{ $infantVaccine->administration_date }}</span> </p> <br>
                                                                        <input type="date" name="administration_date" value="{{ $infantVaccine->administration_date }}">
                        
                                                                    </td>
                                                                    <td>

                                                                       
                                                                    
                                                                     {{ $nextDueDate }}   
                                                                    
                                                                       {{-- ({{ $infants->age }}) --}}
                                                                    </td>
                                                                   <td> <a href="{{ route('send.reminder', ['infant_id' => $infants->id , 'vaccine_id' => $vaccine->id])   }}" class="btn btn-primary btn-sm">Send Remainder Email</a> </td>
                                                                   

                                                                    <td><button type="submit" class="btn btn-inverse-warning">Update / Set The due dates</button></td> 

                                                                    

                                                                </form>
                                                            
                                                        </tr>
                                                    @endif
                                                @endforeach
                            @endforeach
                            

                            </tbody>



                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









@endsection
