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

        <div id="change-pass" class="row">
            <div class="col-sm-12">
                <h1 class="page-header">Cambio de Contraseña</h1>
                <hr>
            </div>
            <div class="col-sm-8">
                <form>
                    <div class="form-group">
                        <label for="password">Nueva contraseña</label>
                        <input type="password" name="pass" class="form-control" v-model="change.password">
                    </div>
                    <div class="form-group">
                        <label for="repeat_password">Repita la nueva contraseña</label>
                        <input type="password" name="repeat_password" class="form-control" v-model="repeat_password">
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" v-on:click.prevent="savePass()">Guardar</button>                      
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection