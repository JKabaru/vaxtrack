<!-- resources/views/completion-rate-by-age.blade.php -->
@extends('admin.admin_dashboard')

@section('admin')

    

<div class="page-content">
    <h1>Vaccination Completion Rates by Infant Age</h1>
    <div class="col-xl-6 grid-margin-center stretch-card">
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
        var pieChartOptions = {
            chart: {
                type: 'pie',
                height: 400
            },
            series: {!! json_encode(array_values($completionRates)) !!},
            labels: {!! json_encode(array_keys($completionRates))  !!},
            colors: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)'
            ],
            tooltip: {
                enabled: true,
                y: {
                    formatter: function (value) {
                        return value + '%';
                    }
                }
            }
        };

        var pieChart = new ApexCharts(document.querySelector('#pieChart'), pieChartOptions);
        pieChart.render();
    });
</script>

@endsection
