@extends("layout.layout")

@section('title_system')
{{$custom_config['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$custom_config['title_nav']['title_nav']}}
@endsection

@section('content')
<div id="attention" class="row mt-4">
	<div class="col-sm-12">
		<h1 class="page-header">Atención al Paciente</h1>
	</div>
    <div class="col-sm-12">
        @can('attention_new')
            @include('guardTeamUser.attention.create')
            <a href="#" class="btn btn-primary float-right mb-4" data-toggle="modal" v-on:click.prevent="newAttention()">Nueva Atención</a>
        @endcan
        <input v-model="search" class="float-right mr-4" type="text" placeholder="buscar por apellido">
        <table class="table table-hover table-striped mt-4">
            <thead>
                <tr>
                    <th class="text-center">Nro Documento</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellido</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="p in filteredAttentions">
                    <td class="text-center">@{{ p.document_number }}</td>
                    <td class="text-center">@{{ p.name }}</td>
                    <td class="text-center">@{{ p.surname }}</td>
                    @can('attention_index') 
                        <td width="10px">
                            <a :href="'/attentions/patient/' + p.id " class="btn btn-info btn-sm">Atenciones</a>
                        </td>
                    @endcan
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection