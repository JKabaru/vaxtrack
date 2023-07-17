@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">

    <h2>Parent Completion Rates</h2>
    <!-- Rest of the content -->

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Top Parents</h6>
                    <!-- Rest of the code for the Top Parents table -->
                    <div class="table-responsive pt-3">
                        <table id="dataTableExample" class="table table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Number of Infants</th>
                                    <th>Total Vaccines</th>
                                    <th>Average Completion Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                               

                                @foreach ($topParents as $parentDetails)
                                <tr>
                                    <td>{{ $parentDetails->name }}</td>
                                    <td>{{ $parentDetails->number_of_infants }}</td>
                                    <td>{{ $parentDetails->total_vaccines }}</td>
                                    <td>{{ $parentDetails->average_completion_rate }}</td>
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
