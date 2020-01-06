@extends("layout.layout")

@section('title_system')
{{$custom_config['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$custom_config['title_nav']['title_nav']}}
@endsection

@section('content')
<div class="col-sm-12">
    <h1 class="page-header mt-4">Gestión de Reportes</h1>
</div>
<div class="col-sm-12">
    <a href="{{ route('report-reason-show') }}" class="btn btn-primary mt-4 ml-4">total de motivos de atención</a>
</div>
@endsection