@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    {{-- <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.infant')}}" class="btn btn-inverse-info">Add Infants</a> 
        </ol>
    </nav> --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title"> Infants Vaccinations </h6>


    
    









    <div class="table-responsive">
        <table id="dataTableExample" class="table">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Infant name</th>
                    <th>Date of birth</th>
                    <th>Parent details</th>
                    <th>Vaccines</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($infants as $infant)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $infant->last_name }} {{ $infant->other_name }}</td>
                        <td>{{ $infant->age }}</td>
                        <td>{{ $infant->parent_email }} - {{ $infant->parent_number }}</td>
                        <td>
                            <ul>
                                @foreach($infantvaccines->where('infant_id', $infant->id) as $infantVaccine)
                                    @php
                                        $vaccine = $filteredVaccine->where('id', $infantVaccine->vaccine_id)->first();
                                    @endphp
                                    @if ($vaccine)
                                        <li>
                                            <span class="badge bg-danger">{{ $vaccine->name }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @foreach($infantvaccines->where('infant_id', $infant->id) as $infantVaccine)
                                {{ $infantVaccine->completed ? 'Completed' : 'Pending' }}<br>
                            @endforeach 
                        </td>
                        <td>
                            <!-- Add action buttons here -->
                            <a href="{{ route('edit.infantvaccinations', $infant->id)}}" class="btn btn-inverse-warning">Edit</a>
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

