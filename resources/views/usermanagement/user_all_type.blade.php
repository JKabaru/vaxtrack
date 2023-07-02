@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('useradd.type')}}" class="btn btn-inverse-info">Add User</a> 
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title"> All Users </h6>
    <div class="table-responsive">


        <form action="{{ route('filter.userType') }}" method="POST" class="mb-3">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <select name="filter_role" class="form-control">
                        <option value="">All Roles</option>
                        <option value="user">User</option>
                        <option value="parent">Parent</option>
                        <option value="admin">Admin</option>
                        <option value="doctor">Doctor</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <select name="filter_status" class="form-control">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="disabled">Disabled</option>
                        <option value="pending">Pending</option>
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
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>role</th>
            <th>phone_number</th>
            <th>address</th>
            <th>Action</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($types as $key => $item)
                <tr>
                    
                    <td>{{ $item-> name }}</td>
                    <td>{{ $item-> email }}</td>
                    <td>{{ $item-> status }}</td>
                    <td>{{ $item-> role }}</td>
                    <td>{{ $item-> phone_number }}</td>
                    <td>{{ $item-> address }}</td>

                  <td>
                    <a href="{{ route('useredit.type', $item->id)}}" class="btn btn-inverse-warning">Edit</a>
                    <a href="{{ route('delete.usertype', $item->id)}}" class="btn btn-inverse-danger" id= "delete">Delete</a>
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