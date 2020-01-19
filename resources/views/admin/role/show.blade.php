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
<div id="role">

    <div class="row bg-dark text-white section-nav">
        <div class="col-sm-6">
            <h3 class="ml-4 mt-2 pt-1 pb-1 page-header">Asignación de Roles</h3>
        </div>
        <div class="col-sm-6">
            <ul class="mr-4 navbar-nav navbar-expand-lg justify-content-end">
                <li class="nav-item form-inline float-right">
                    <div class="pt-1 pb-1 mt-2 mr-4">
                        <input class="form-control" placeholder="buscar..." type="text" v-model="search">
                        <button class="button-dark-nav" v-on:click.prevent="searchUserRole()" type="button"><i class="fa fa-search"></i></button>        
                    </div>
                </li>
            </ul>
       </div>
    </div>

    <div class="container container-main mt-4 mb-5">
        <div class="shadow bg-white pr-3 pl-3 pb-3 pt-3">

            <div class="row">
                
                <div class="col-sm-12">
                    <table class="table table-hover table-striped">
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
                                        <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="editRole(u)"><i style="font-size:19px" class="fa fa-pencil"></i></a>
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
    </div>

</div>
@endsection