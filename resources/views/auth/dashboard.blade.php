@extends('layout.main')

@section('title', 'Dashboard')
@section('subtitle', 'Dashboard')
@section('content')

<div>
    <h4 class="card-title">Dashboard</h4>
    <p class="card-description"></p>
    Anggota : {{ count($anggota) }} <br>
    Tim : {{ count($tim) }} <br>
    Proyek : {{ count($proyek) }} <br>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Grafik ini menunjukkan perbandingan antar tim dengan jumlah proyek yang dimiliki.
    </p>
</figure>

<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
</style>

<script>
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Perbandingan Tim'
    },
    subtitle: {
        text: 'Sumber: Sub Menu List'
    },
    xAxis: {
        categories: [
            @foreach ($proyektim as $item )
                '{{ $item->nama_tim }}',
            @endforeach
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Proyek'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        series: 'tim',
        data: [@foreach ($proyektim as $item )
            {{ $item->jumlahProyek }},
        @endforeach
    ]
    }]
});
</script>

</div>

@endsection
