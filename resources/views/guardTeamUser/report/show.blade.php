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

@section('content')    
<div class="container container-main mt-5 mb-5">
    <div class="shadow bg-white pr-3 pl-3 pb-3 pt-3">    
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-header">Gestión de Reportes</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <a href="{{ route('report-reason-show') }}" class="btn btn-primary mt-4 ml-4">total de motivos de atención</a>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('report-gender-show') }}" class="btn btn-primary mt-4 ml-4">generos de pacientes atendidos</a>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('report-reason-show') }}" class="btn btn-primary mt-4 ml-4">localidades de pacientes atendidos</a>
            </div>
        </div>
    </div>
</div>
@endsection