@extends("layout.layout")

@section('title_system')
{{$customConfig['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$customConfig['title_nav']['title_nav']}}
@endsection

@section('content')
<form action="">
    <div id="config" class="row mt-4">
        <div class="col-sm-12">
            <h1 class="page-header mb-4">Configuración del Sistema</h1>
            @can('config_update')
                @include('admin.configuration.edit')
                <a href="#" v-if="editMode" class="btn btn-primary float-right" v-on:click.prevent="updateConfig()">Guardar Cambios</a>
                <a href="#" v-else class="btn btn-warning float-right" v-on:click.prevent="editConfig()">Editar</a>  
            @endcan
        </div>
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
            <div class="form-group">
                <label for="text">Correo Electrónico</label>
                <div class="container">
                    <input v-if="editMode" type="email" class="form-control" v-model="configs.email.email">
                    <input v-else type="email" class="form-control" v-model="configs.email.email" disabled>
                    <small class="text-muted">
                        @{{ configs.email.descrip }}
                    </small>
                </div>
            </div>
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
            <div class="form-group">
                <label for="text">Paginación</label>
                <div class="container">
                    <input v-if="editMode" type="text" pattern="[0-9]" class="form-control" v-model="configs.pagination.pagination">
                    <input v-else type="text" pattern="[0-9]" class="form-control" v-model="configs.pagination.pagination" disabled>
                    <small class="text-muted">
                        @{{ configs.pagination.descrip }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection