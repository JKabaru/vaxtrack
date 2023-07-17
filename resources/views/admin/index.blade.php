

@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
      </div>
      <div class="d-flex align-items-center flex-wrap text-nowrap">
        <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
          <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
          <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
        </div>
        {{-- <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
          <i class="btn-icon-prepend" data-feather="printer"></i>
          Print
        </button>
        <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
          <i class="btn-icon-prepend" data-feather="download-cloud"></i>
          Download Report
        </button> --}}
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">New Users</h6>
                  <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item d-flex align-items-center" href="{{ route('userall.type') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View All Users</span></a>
                      
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $newUsersCount }}</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-{{ $userspercentageIncrease > 0 ? 'success' : 'danger' }}">
                        <span>{{ $userspercentageIncrease }}%</span>
                        <i data-feather="{{ $userspercentageIncrease > 0 ? 'arrow-up' : 'arrow-down' }}" class="icon-sm mb-1"></i>
                      </p>
                    </div>
                  </div>
                  <div class="col-6 col-md-12 col-xl-7">
                    <div id="usersChart" class="mt-md-3 mt-xl-0"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">New Vaccines</h6>
                  <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <a class="dropdown-item d-flex align-items-center" href="{{ route('all.type') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View All Vaccines  </span></a>
                      
                   
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $newVaccinesCount }}</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-{{ $vaccinespercentageIncrease > 0 ? 'success' : 'danger' }}">
                        <span>{{ $vaccinespercentageIncrease }}%</span>
                        <i data-feather="{{ $vaccinespercentageIncrease > 0 ? 'arrow-up' : 'arrow-down' }}" class="icon-sm mb-1"></i>
                      </p>
                    </div>
                  </div>
                  <div class="col-6 col-md-12 col-xl-7">
                    <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">New Infants</h6>
                  <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="{{ route('all.infants') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">All Infants </span></a>
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $newInfantsCount }}</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-{{ $infantspercentageIncrease > 0 ? 'success' : 'danger' }}">
                        <span>{{ $infantspercentageIncrease }}%</span>
                        <i data-feather="{{ $infantspercentageIncrease > 0 ? 'arrow-up' : 'arrow-down' }}" class="icon-sm mb-1"></i>
                      </p>
                    </div>
                  </div>
                  <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- row -->


    <div class="row">
      <div class="col-lg-7 col-xl-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">Completed Vaccines (Monthly) </h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.infantVaccinations') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View all vaccine schedules </span></a>
                 
                </div>
              </div>
            </div>
            <p class="text-muted">Here we see the total vaccines completed monthly</p>
            <div id="monthlyChart"></div>
          </div> 
        </div>
      </div>
      
      <script>
        var monthlyCompletedVaccines = @json($monthlyCompletedVaccines);
        var monthlyPendingVaccines = @json($monthlyPendingVaccines);
    
        // Prepare data for the monthly chart
        var completedChartLabels = monthlyCompletedVaccines.map(data => data.date);
        var completedChartValues = monthlyCompletedVaccines.map(data => data.count);
        var pendingChartLabels = monthlyPendingVaccines.map(data => data.date);
        var pendingChartValues = monthlyPendingVaccines.map(data => data.count);
    
        // Filter the last six months from now
        var today = new Date();
        var sixMonthsAgo = new Date(today.getFullYear(), today.getMonth() - 5, 1);
        var filteredCompletedChartLabels = completedChartLabels.filter(date => new Date(date) >= sixMonthsAgo);
        var filteredCompletedChartValues = completedChartValues.slice(-6);
        var filteredPendingChartLabels = pendingChartLabels.filter(date => new Date(date) >= sixMonthsAgo);
        var filteredPendingChartValues = pendingChartValues.slice(-6);
    
        // Create the monthly chart
        var options = {
            chart: {
                type: 'bar',
                height: 400,
                stacked: false
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '45%'
                },
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'Number of Completed Vaccines',
                data: filteredCompletedChartValues
            }, {
                name: 'Number of Pending Vaccines',
                data: filteredPendingChartValues
            }],
            xaxis: {
                categories: filteredCompletedChartLabels
            },
            yaxis: {
                title: {
                    text: 'Number of Vaccines'
                }
            },
            colors: ['#5A8DEE', '#FFC107'],
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + ' vaccines';
                    }
                }
            }
        };
    
        var monthlySalesChart = new ApexCharts(document.querySelector("#monthlyChart"), options);
        monthlySalesChart.render();
    </script>
    
    
      


    <div class="row">
      <div class="col-lg-5 col-xl-12 grid-margin grid-margin-xl-0 stretch-card">
          <div class="card">
              <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                      <h6 class="card-title mb-0">Pending Users </h6>
                      <div class="dropdown">
                          <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                              <a class="dropdown-item" href="{{ route('userall.type') }}"><i data-feather="eye" class="icon-sm me-2"></i> View All Users</a>
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
                                          <a href="{{ route('send.verification', ['user_id' => $user->id]) }}" class="btn btn-primary btn-sm">Send Verify Email</a>
                                          <a href="{{ route('useredit.type', $user->id) }}" class="btn btn-secondary btn-sm">Edit</a>
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