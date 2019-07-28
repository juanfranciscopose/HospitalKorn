@extends("layout.layout")

@section('title_system')
{{$customConfig['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$customConfig['title_nav']['title_nav']}}
@endsection

@section('content')
<h3 class="mt-4 text-center">El usuario está <strong>INACTIVO</strong></h3>
<h5 class="mt-4 text-center">comunicarse con servicio tecnico</h5>
@endsection