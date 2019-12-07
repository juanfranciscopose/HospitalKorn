@extends("layout.layout")

@section('title_system')
{{$custom_config['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$custom_config['title_nav']['title_nav']}}
@endsection

@section('content')
<div id="user-crud" class="row mt-4">
	<div class="col-sm-12">
		<h1 class="page-header">Gestión de Usuarios</h1>
	</div>
    <div class="col-sm-12">
        @can('user_new')
            @include('admin.user.create')
            <a href="#" class="btn btn-primary float-right mb-4" data-toggle="modal" v-on:click.prevent="newUser()">Nuevo Usuario</a>
        @endcan
        <table class="table table-hover table-striped mt-4">
            <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="u in users">
                    <td class="text-center">@{{ u.id }}</td>
                    <td class="text-center">@{{ u.email }}</td>
                    <td v-if="u.active == 1" class="text-center">activo</td>
                    <td v-else class="text-center">inactivo</td>
                    @can('user_show')
                        @include('admin.user.details')
                        <td width="10px">
                            <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="detailsUser(u)">Detalles</a>
                        </td>
                    @endcan
                    @can('user_update')
                        @include('admin.user.edit')
                        <td width="10px">
                            <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editUser(u)">Editar</a>
                        </td>
                    @endcan
                    @can('user_destroy')
                        @include('admin.user.delete')
                        <td width="10px">
                            <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="destroyUser(u)">Eliminar</a>
                        </td>
                    @endcan
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection