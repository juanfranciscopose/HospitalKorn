@extends("layout.layout")

@section('title_system')
{{$custom_config['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$custom_config['title_nav']['title_nav']}}
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
@endsection

@section('content')
<div class="col-sm-12">
    <h1 class="page-header mt-4">Consultas por motivo</h1>
</div>
<hr>
<div class="col-sm-12">
    <h4>totales</h4>
    <ul>
        <li class="list-group">Receta médica: {{ $reason['prescription'] }}</li>
        <li class="list-group">Control de guardia: {{ $reason['guard_control'] }}</li>
        <li class="list-group">Consulta: {{ $reason['consultation'] }}</li>
        <li class="list-group">Intento de suicidio: {{ $reason['suicide_attempt'] }}</li>
        <li class="list-group">Interconsulta: {{ $reason['interconsultation'] }}</li>
        <li class="list-group">Otras: {{ $reason['other'] }}</li>
    </ul>
    <canvas class="mt-4 mb-4" id="myChart"></canvas>
</div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        Chart.defaults.global.defaultFontFamily = 'sans-serif';
        Chart.defaults.global.defaultFontSize = 12;

        var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Receta médica', 'Control de guardia', 'Consulta', 'Intento de suicidio', 'Interconsulta', 'Otras'],
            datasets: [{
                label: 'Motivo',
                data: [ {{ $reason['prescription'] }}, {{ $reason['guard_control'] }},  {{ $reason['consultation'] }}, {{ $reason['suicide_attempt'] }}, {{ $reason['interconsultation'] }}, {{ $reason['other'] }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection