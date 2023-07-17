


@extends('admin.admin_dashboard')
@section('admin')

<!-- resources/views/completion-rate-by-age.blade.php -->

   

<div class="page-content">
    <h1>Vaccination Completion Rates by Vaccines</h1>
    <div class="col-xl-12 grid-margin-center stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Pie Chart</h6>
                <div id="pieChart"></div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var completionRates = {!! json_encode(array_values($completionRates)) !!};
        var labels = {!! json_encode(array_keys($completionRates ))  !!};
        
        var options = {
            chart: {
                type: 'pie',
                height: 400,
            },
            series: completionRates,
            labels: labels,
            colors: [
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0',
                '#9966FF',
                '#FF9F40'
            ],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + '%';
                    }
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var pieChart = new ApexCharts(document.querySelector("#pieChart"), options);
        pieChart.render();
    });
</script>

@endsection



