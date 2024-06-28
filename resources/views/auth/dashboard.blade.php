@extends('layout.main')

@section('title', 'Dashboard')
@section('subtitle', 'Dashboard')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kimia</h5>
                <p class="card-text">{{ count($kimia) }} Kimia, Total Jumlah: {{ $kimia_total_jumlah }}</p>
                <a href="{{ url('listkimia') }}" class="btn btn-primary">Lihat Daftar Kimia</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Komputer</h5>
                <p class="card-text">{{ count($komputer) }} Komputer, Total Jumlah: {{ $komputer_total_jumlah }}</p>
                <a href="{{ url('listkomputer') }}" class="btn btn-primary">Lihat Daftar Komputer</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Resep</h5>
                <p class="card-text">{{ count($resep) }} Resep, Total Jumlah: {{ $resep_total_jumlah }}</p>
                <a href="{{ url('listresep') }}" class="btn btn-primary">Lihat Daftar Resep</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Simplisa</h5>
                <p class="card-text">{{ count($simplisa) }} Simplisa, Total Jumlah: {{ $simplisa_total_jumlah }}</p>
                <a href="{{ url('listsimplisa') }}" class="btn btn-primary">Lihat Daftar Simplisa</a>
            </div>
        </div>
    </div>
</div>

<div>
    <canvas id="kimia-chart" width="400" height="200"></canvas>
</div>
<div>
    <canvas id="komputer-chart" width="400" height="200"></canvas>
</div>
<div>
    <canvas id="resep-chart" width="400" height="200"></canvas>
</div>
<div>
    <canvas id="simplisa-chart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('kimia-chart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [@foreach($years as $year) '{{ $year }}', @endforeach],
            datasets: [{
                label: 'Number of Kimia',
                data: [@foreach($kimia_per_tahun as $item) {{ $item->count }}, @endforeach],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }, {
                label: 'Total Jumlah Kimia',
                data: [@foreach($kimia_per_tahun as $item) {{ $item->total_jumlah }}, @endforeach],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx2 = document.getElementById('komputer-chart').getContext('2d');
    const chart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: [@foreach($komputer_years as $year) '{{ $year }}', @endforeach],
            datasets: [{
                label: 'Number of Komputer',
                data: [@foreach($komputer_per_tahun as $item) {{ $item->count }}, @endforeach],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }, {
                label: 'Total Jumlah Komputer',
                data: [@foreach($komputer_per_tahun as $item) {{ $item->total_jumlah }}, @endforeach],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx3 = document.getElementById('resep-chart').getContext('2d');
    const chart3 = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: [@foreach($resep_years as $year) '{{ $year }}', @endforeach],
            datasets: [{
                label: 'Number of Resep',
                data: [@foreach($resep_per_tahun as $item) {{ $item->count }}, @endforeach],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }, {
                label: 'Total Jumlah Resep',
                data: [@foreach($resep_per_tahun as $item) {{ $item->total_jumlah }}, @endforeach],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx4 = document.getElementById('simplisa-chart').getContext('2d');
    const chart4 = new Chart(ctx4, {
        type: 'line',
        data: {
            labels: [@foreach($simplisa_years as $year) '{{ $year }}', @endforeach],
            datasets: [{
                label: 'Number of Simplisa',
                data: [@foreach($simplisa_per_tahun as $item) {{ $item->count }}, @endforeach],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }, {
                label: 'Total Jumlah Simplisa',
                data: [@foreach($simplisa_per_tahun as $item) {{ $item->total_jumlah }}, @endforeach],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
