@extends('admin.admin_dashboard')
@section('admin')

<div class="row">
    <div class="col-lg-5 col-xl-12 grid-margin grid-margin-xl-0 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="card-title mb-0">Disabled Users </h6>
                    <div class="dropdown">
                        <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                            <a class="dropdown-item" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> View All Users</a>
                            <!-- Uncomment the lines below if needed -->
                            {{-- <a class="dropdown-item" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> Edit</a>
                            <a class="dropdown-item" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> Delete</a>
                            <a class="dropdown-item" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> Print</a>
                            <a class="dropdown-item" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> Download</a> --}}
                        </div>
                    </div>
                </div>


    


                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                   
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ optional($user->created_at)->format('h:i A') }}</td>

                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('send.verification', ['user_id' => $user->id]) }}" class="btn btn-primary btn-sm">Send Activation Email</a>
                                        <a href="{{ route('useredit.type', $user->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                        <a href="{{ route('delete.usertype' ,  $user->id) }}" class="btn btn-secondary btn-sm">Delete</a>
                                        
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


@endsection