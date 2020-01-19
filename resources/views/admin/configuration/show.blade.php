@extends("layout.layout")

@section('title_system')
{{$customConfig['title_system']['title_system']}}
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

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<div class="container container-main mt-5 mb-5">
    <div class="shadow bg-white pr-3 pl-3 pb-3 pt-3">
        <div id="config">

            <div class="row">
                <div class="col-sm-12">
                    <h1 class="page-header">Configuración del Sistema</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    @can('config_update')
                        <a href="#" v-if="editMode" class="btn btn-success float-right mb-4" v-on:click.prevent="updateConfig()"><i style="font-size:19px" class="fa fa-cloud-upload"></i> Guardar Cambios</a>
                        <a href="#" v-else class="btn btn-info float-right mb-4" v-on:click.prevent="editConfig()"><i style="font-size:19px" class="fa fa-pencil"></i> Editar</a>  
                    @endcan
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="text">Título de Barra de Navegación</label>
                        <div class="container">
                            <input v-if="editMode" type="text" class="form-control" minlength="5" maxlength="190" title="Tamaño mínimo: 5. Tamaño máximo: 190" v-model="configs.title_nav.title_nav">
                            <input v-else type="text" class="form-control" minlength="5" maxlength="190" title="Tamaño mínimo: 5. Tamaño máximo: 190" v-model="configs.title_nav.title_nav" disabled>
                            <small class="text-muted">
                                @{{ configs.title_nav.descrip }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="text">Título del Sistema</label>
                        <div class="container">
                            <input v-if="editMode" type="text" class="form-control" minlength="5" maxlength="190" title="Tamaño mínimo: 5. Tamaño máximo: 190" v-model="configs.title_system.title_system">
                            <input v-else type="text" class="form-control" minlength="5" maxlength="190" title="Tamaño mínimo: 5. Tamaño máximo: 190" v-model="configs.title_system.title_system" disabled>
                            <small class="text-muted">
                                @{{ configs.title_system.descrip }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="text">Correo Electrónico</label>
                        <div class="container">
                            <input v-if="editMode" type="email" class="form-control" v-model="configs.email.email">
                            <input v-else type="email" class="form-control" title="correo electronico institucional" v-model="configs.email.email" disabled>
                            <small class="text-muted">
                                @{{ configs.email.descrip }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="text">Descripción</label>
                        <div class="container">
                            <input v-if="editMode" type="text" class="form-control" minlength="5" maxlength="190" title="Tamaño mínimo: 5. Tamaño máximo: 190" v-model="configs.description.description">
                            <input v-else type="text" class="form-control" minlength="5" maxlength="190" title="Tamaño mínimo: 5. Tamaño máximo: 190" v-model="configs.description.description" disabled>
                            <small class="text-muted">
                                @{{ configs.description.descrip }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="text">Paginación</label>
                        <div class="container">
                            <input v-if="editMode" type="number"class="form-control" v-model="configs.pagination.pagination">
                            <input v-else type="number" class="form-control" title="paginacion" v-model="configs.pagination.pagination" disabled>
                            <small class="text-muted">
                                @{{ configs.pagination.descrip }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection