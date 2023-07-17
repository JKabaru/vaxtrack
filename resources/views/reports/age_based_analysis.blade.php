<!-- resources/views/age-based-analysis.blade.php -->
@extends('admin.admin_dashboard')

@section('admin')
    
<div class="page-content">
    @include('reports.doctorcompletion')
</div>

    {{-- <div class="page-content">
        <h1>Age-Based Vaccination Analysis</h1>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Table</h6>
                        
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Vaccine</th>
                                        <th>Recommended Age</th>
                                        <th>Average Age</th>
                                        <th>Median Age</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vaccines as $vaccine)
                                        <tr>
                                            <td>{{ $vaccine->name }}</td>
                                            <td>{{ $vaccine->recommended_age }}</td>
                                            <td>{{ $vaccine->average_age }}</td>
                                            <td>{{ $vaccine->median_age }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    
@endsection
