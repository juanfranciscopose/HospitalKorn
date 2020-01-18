@extends("layout.layout")

@section('title_system')
{{$custom_config['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$custom_config['title_nav']['title_nav']}}
@endsection

@section('email')
{{$custom_config['email']['email']}}
@endsection

@section('description')
{{$custom_config['description']['description']}}
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
@endsection

@section('content')
<div class="container container-main mt-5 mb-5">
    <div class="shadow bg-white pr-3 pl-3 pb-3 pt-3">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-header">Consultas por genero de paciente</h1>
                <hr>
            </div>
            <hr>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h4>totales</h4>
                <ul>
                    <li class="list-group">Masculino: {{ $gender['male'] }}</li>
                    <li class="list-group">Femenino: {{ $gender['female'] }}</li>
                    <li class="list-group">Trans: {{ $gender['shemale'] }}</li>
                    <li class="list-group">Otros: {{ $gender['other'] }}</li>
                </ul>
                <canvas class="mt-4 mb-4" id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    Chart.defaults.global.defaultFontFamily = 'sans-serif';
    Chart.defaults.global.defaultFontSize = 12;

    var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Masculino', 'Femenino', 'Trans', 'Otros'],
        datasets: [{
            label: 'Genero',
            data: [ {{ $gender['male'] }}, {{ $gender['female'] }},  {{ $gender['shemale'] }}, {{ $gender['other'] }} ],
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