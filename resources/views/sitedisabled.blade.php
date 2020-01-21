@extends("layout.layout")

@section('title_system')
{{$customConfig['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$customConfig['title_nav']['title_nav']}}
@endsection

@section('title_nav')
{{$customConfig['title_nav']['title_nav']}}
@endsection

@section('email')
{{$customConfig['email']['email']}}
@endsection

@section('description')
{{$customConfig['description']['description']}}
@endsection

@section('content')
<div class="container container-main mt-4 mb-5">
    <div class="shadow bg-white pr-3 pl-3 pb-3 pt-3">
        <h3 class="mt-4 text-center">El sitio está <strong>DESHABILITADO</strong></h3>
        <h5 class="mt-4 text-center">comunicarse con servicio tecnico</h5>
    </div>
</div>
@endsection