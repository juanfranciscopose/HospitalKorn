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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<div id="user-crud" >

    <div class="row bg-dark text-white section-nav">
        <div class="col-sm-4">
            <h3 class="ml-4 mt-2 pt-1 pb-1 page-header">Gestión de Usuarios</h3>
        </div>
        <div class="col-sm-8">
            <ul class="mr-4 navbar-nav navbar-expand-lg justify-content-end">
                <li class="nav-item">
                    <div class="pt-1 pb-1 mr-4 mt-2">
                        @can('user_new')
                            @include('admin.user.create')
                            <button href="#" class="button-dark-nav float-right" data-toggle="modal" v-on:click.prevent="newUser()">Nuevo Usuario</button>
                        @endcan
                    </div>
                </li>
                <li>
                    <div class="pt-1 pb-1 mt-2 mr-4">
                        <button href="#" v-on:click="showAssignRoles()" class="button-dark-nav">Asignar Roles</button>
                    </div>
                </li>
                <li class="nav-item form-inline float-right">
                    <div class="pt-1 pb-1 mt-2 mr-4">
                        <input class="form-control" placeholder="buscar..." type="text" v-model="search">
                        <button class="button-dark-nav" v-on:click.prevent="searchUser()" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </li>
            </ul>
       </div>
    </div>

    <div class="container container-main mt-4 mb-5">
        <div class="shadow bg-white pr-3 pl-3 pb-3 pt-3">

            <div class="row">
                
                <div class="col-sm-12">
                    <table class="table table-hover table-striped mt-4">
                        <thead>
                            <tr>
                                <th class="text-center">Email</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="u in users">
                                <td class="text-center">@{{ u.email }}</td>
                                <td v-if="u.active == 1" class="text-center">activo</td>
                                <td v-else class="text-center">inactivo</td>
                                @can('user_show')
                                    @include('admin.user.details')
                                    <td width="10px">
                                        <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="detailsUser(u)"><i style="font-size:19px" class="fa fa-ellipsis-h"></i></a>
                                    </td>
                                @endcan
                                @can('user_update')
                                    @include('admin.user.edit')
                                    <td width="10px">
                                        <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="editUser(u)"><i style="font-size:19px" class="fa fa-pencil"></i></a>
                                    </td>
                                @endcan
                                @can('user_destroy')
                                    @include('admin.user.delete')
                                    <td width="10px">
                                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="destroyUser(u)"><i style="font-size:19px" class="fa fa-trash-o"></i></a>
                                    </td>
                                @endcan
                            </tr>
                        </tbody>
                    </table>
                    @include('pagination')
                </div>

            </div>

        </div>
    </div>

</div>

@endsection