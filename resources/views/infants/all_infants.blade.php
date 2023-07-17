@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.infant')}}" class="btn btn-inverse-info">Add Infants</a> 
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title"> All Infants </h6>
    <div class="table-responsive">

      <form action="{{ route('filter.infantType') }}" method="POST" class="mb-3">
        @csrf
        <div class="row">
            {{-- <div class="col-md-4">
                <select name="filter_age" class="form-control">
                    <option value="">Select Age Group</option>
                    <option value="0">Birth</option>
                    <option value="2">2 months</option>
                    <option value="4">4 months</option>
                    <option value="6">6 months</option>
                    <option value="9">9 months</option>
                    <option value="12">12 months</option>
                </select>
            </div> --}}

            <div class="col-md-4">
                <select name="filter_gender" class="form-control">
                    <option value="">All Genders</option>
                    <option   value="Male" >Male</option>
                    <option   value="Female" >Female</option>
                </select>
            </div>


            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>







      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Sl</th>
            <th>Infant name</th>
            <th>Gender name</th>
            <th>Age  Group (in months )</th>
            <th>Action</th>
            
          </tr>
        </thead>
        <tbody>

          

            @foreach($infants as $key => $item)

            @php

                        
                         $birthdate = \Carbon\Carbon::createFromDate($item->age); // Replace with the actual birthdate
                         $currentDate = \Carbon\Carbon::today();
        
                         $age = $currentDate->diffInMonths($birthdate);
                       
                         $ageRange = \App\Models\AgeRange::where('StartAge', '<=', $age)
                                                                        ->where('EndAge', '>=', $age)
                                                                        ->first();
        
    
            @endphp




                <tr>
                    
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->last_name }}  {{ $item->other_name }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>@if ($ageRange)
                      {{ $ageRange->StartAge }} months -  {{ $ageRange->EndAge }} months
                  @else
                      Age range not available
                  @endif</td>


                  <td>
                    <a href="{{ route('edit.infant', $item->id)}}" class="btn btn-inverse-warning">Edit</a>
                    <a href="{{ route('delete.permission', $item->id)}}" class="btn btn-inverse-danger" id = "delete">Delete</a>
                </td> 
                 

                </tr>
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