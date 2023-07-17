@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.roles')}}" class="btn btn-inverse-info">Mark infants Vaccines</a> 
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> All Infants And their Vaccines </h6>


                    <form action="{{ route('filter.infants.vaccinations.country') }}" method="GET">
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Country</label>
                            <select id="status" name="country_id" class="form-control">
                                <option selected >Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->CountryName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>










                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Infants name</th>
                                    <th>Age range</th>
                                    <th>Vaccines</th>
                                    <th>Action</th>
                                </tr>
                            </thead>



                            <tbody>
                                @foreach($infants as $key => $infant)
                                @php
                                        

                        
                                        $birthdate = \Carbon\Carbon::createFromDate($infant->age); // Replace with the actual birthdate
                                        $currentDate = \Carbon\Carbon::today();

                                        $age = $currentDate->diffInMonths($birthdate);

                                        // $ageRange = \App\Models\AgeRange::where('StartAge', '<=', $age)
                                        //                                             ->where('EndAge', '>=', $age)
                                        //                                             ->first();


                                    
                                    @endphp
                            
                            
                                    @php

                                           $agerangesToconsider = $AgeRangesFromController->filter(function ($ageRange) use ($age) {
                                                    return ($ageRange->StartAge <= $age && $ageRange->EndAge >= $age) || $ageRange->StartAge > $age ;
                                                })->pluck('id')->toArray();
                                                        
                                        $recommendedVaccines = $vaccines->whereIn('age_range_id', $agerangesToconsider);
                                    
                                       
                                        $infantVaccines = $infantvaccines->where('infant_id', '==', $infant->id)->pluck('vaccine_id')->toArray();
                                       
                                        $noVaccinesAvailable = false;
                                        $hasVaccines = false;
                                    @endphp
                                    
                                    @foreach($recommendedVaccines as $vaccine)
                                        @php
                                            $isVaccineTaken = in_array($vaccine->id,$infantVaccines);
                                        @endphp
                                        @if(!$isVaccineTaken)
                                            @php
                                                $hasVaccines = true;
                                                break;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if($hasVaccines)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $infant->last_name }} {{ $infant->other_name }}</td>
                                            <td> {{ $infant->age}}</td>
                                            <td>
                                                @foreach($recommendedVaccines as $vaccine)
                                                    @php
                                                        $isVaccineTaken = in_array($vaccine->id, $infantVaccines);
                                                    @endphp
                                                    @if(!$isVaccineTaken)

                                                    @php
                                                    $vaccine = $filteredVaccine->where('id', $vaccine->id)->first();
                                                @endphp
                                                        <span class="badge bg-warning">{{ $vaccine ? $vaccine->name : '' }}</span>

                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.schedule', $infant->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="infant" value="{{ $infant->id }}">
                                                    <button type="submit" class="btn btn-inverse-warning">Schedule</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
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
