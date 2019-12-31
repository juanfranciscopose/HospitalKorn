@extends("layout.layout")

@section('title_system')
{{$custom_config['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$custom_config['title_nav']['title_nav']}}
@endsection

@section('content')
<form action="">
    <div id="role" class="row mt-4">
        <div class="col-sm-12">
            <h1 class="page-header mb-4">Asignación de Roles del Sistema</h1>
        </div>
        <div class="col-sm-12">
            <table class="table table-hover table-striped mt-4">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="u in users">
                        <td class="text-center">@{{ u.user_id }}</td>
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
</form>
@endsection