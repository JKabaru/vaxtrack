@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.type')}}" class="btn btn-inverse-info">Add Vaccines</a> 
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title"> All Vaccines </h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Recommended age</th>
            <th>Dosage </th>
            <th>Country </th>
            <th>Action</th>
            
          </tr>
        </thead>
        <tbody>
         

            @foreach($types as $key => $item)
                <tr>
                    
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->agerange->StartAge }}months - {{ $item->agerange->EndAge }}months  <br>{{ $item->description }} </td>
                    <td>{{ $item->dose_number }}</td>
                    <td>{{ $item->country->CountryName }}</td>
                   
                  <td>
                    <a href="{{ route('edit.type', $item->id)}}" class="btn btn-inverse-warning">Edit</a>
                    <a href="{{ route('delete.type', $item->id)}}" class="btn btn-inverse-danger" id = "delete">Delete</a>
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