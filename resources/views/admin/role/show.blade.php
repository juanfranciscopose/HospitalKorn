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
<div id="role">

    <div class="row mt-4" >
        <div class="col-sm-12">
            <h1 class="page-header mb-4">Asignación de Roles del Sistema</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-inline float-right" >
                <input class="form-control mr-sm-2" type="text" v-model="search">
                <button class="btn btn-primary" v-on:click.prevent="searchUserRole()" type="button">Buscar</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-striped mt-4">
                <thead>
                    <tr>
                        <th class="text-center">Email</th>
                        <th class="text-center">Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="u in users">
                        <td class="text-center">@{{ u.email }}</td>
                        <td class="text-center">@{{ u.name }}</td>
                        @can('user_update')
                        @include('admin.role.edit')
                            <td width="10px">
                                <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editRole(u)">Editar</a>
                            </td>
                        @endcan
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @include('pagination')
        </div>
    </div>
    
</div>

@endsection