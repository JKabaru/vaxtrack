

@extends('admin.admin_dashboard')
@section('admin')

<div class="row">
    <div class="col-lg-5 col-xl-12 grid-margin grid-margin-xl-0 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="card-title mb-0">Notifications </h6>
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
                                <th>Type </th>
                                <th>Notification</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->data['title'] }}</td>
                                    <td>{{ $notification->data['message'] }}</td>
                                    <td>{{ $notification->created_at }}</td>
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