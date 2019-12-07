@extends("layout.layout")

@section('title_system')
{{$custom_config['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$custom_config['title_nav']['title_nav']}}
@endsection

@section('content')
<div id="patient_attentions" class="row mt-4">
    <div class="col-sm-12">
        <h1 class="page-header">Atención al Paciente</h1>
    </div>
	<div class="col-sm-12">
        <div :patient="{{$id}}" class="container">
            <h4 class="page-header">Paciente:{{ $name }}</h4>
        </div>
	</div>
    <div class="col-sm-12">
        <table class="table table-hover table-striped mt-4">
            <thead>
                <tr>
                    <th class="text-center">Diagnostico</th>
                    <th class="text-center">Motivo</th>
                    <th class="text-center">Fecha</th>
                </tr>
            </thead>
            <tbody>
                            </tbody>
        </table>
    </div>
</div>
@endsection