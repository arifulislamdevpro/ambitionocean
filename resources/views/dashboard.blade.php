@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Chartjs', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Employee Manager control panel</p>
        </div>
        <div class="text-muted">
            Signed in as <strong>{{ $user->name }}</strong>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-4 col-12">
            <x-adminlte-small-box title="{{ $stats['users'] }}" text="Registered users" icon="fas fa-users" theme="info" />
        </div>
        <div class="col-lg-4 col-12">
            <x-adminlte-small-box title="{{ $stats['roles'] }}" text="Available roles" icon="fas fa-user-shield" theme="success" />
        </div>
        <div class="col-lg-4 col-12">
            <x-adminlte-small-box title="{{ $stats['permissions'] }}" text="Permission rules" icon="fas fa-key" theme="warning" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card title="Employees per Department" theme="primary" icon="fas fa-chart-pie">
                <canvas id="deptChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </x-adminlte-card>
        </div>
        <div class="col-md-6">
            <x-adminlte-card title="Attendances (Last 7 Days)" theme="lightblue" icon="fas fa-chart-bar">
                <canvas id="attChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('js')
<script>
$(function () {
    // 1. Department Chart (Pie)
    var deptChartCanvas = $('#deptChart').get(0).getContext('2d');
    var deptData = {
        labels: {!! json_encode($deptChartData['labels']) !!},
        datasets: [
            {
                data: {!! json_encode($deptChartData['data']) !!},
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#8e44ad', '#2c3e50']
            }
        ]
    };
    var deptOptions = {
        maintainAspectRatio : false,
        responsive : true,
    };
    new Chart(deptChartCanvas, {
        type: 'pie',
        data: deptData,
        options: deptOptions
    });

    // 2. Attendance Chart (Bar)
    var attChartCanvas = $('#attChart').get(0).getContext('2d');
    var attData = {
        labels: {!! json_encode($attChartData['labels']) !!},
        datasets: [
            {
                label: 'Attendances',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: {!! json_encode($attChartData['data']) !!}
            }
        ]
    };
    var attOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    precision: 0
                }
            }]
        }
    };
    new Chart(attChartCanvas, {
        type: 'bar',
        data: attData,
        options: attOptions
    });
});
</script>
@stop
