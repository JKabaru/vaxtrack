@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <h2>Doctor Completion Rates</h2>
    {{-- <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Doctor Completion Rates</h6>

                    <div class="table-responsive">
                        <table id="doctorCompletionRatesTable" class="table">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Completion Rate (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctorCompletionRates as $doctorName => $completionRate)
                                    <tr>
                                        <td>{{ $doctorName }}</td>
                                        <td>{{ $completionRate }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Doctors</h6>
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
                               

                                @foreach ($topDoctors as $doctorDetails)
                                <tr>
                                    <td>{{ $doctorDetails->name }}</td>
                                    <td>{{ $doctorDetails->number_of_infants }}</td>
                                    <td>{{ $doctorDetails->total_vaccines }}</td>
                                    <td>{{ $doctorDetails->average_completion_rate }}</td>
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
