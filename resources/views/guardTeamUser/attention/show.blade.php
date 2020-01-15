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
<div id="attention" class="row mt-4">
	<div class="col-sm-12">
		<h1 class="page-header">Atención al Paciente</h1>
	</div>
    <div class="col-sm-12">
        @can('attention_new')
            @include('guardTeamUser.attention.create')
            <a href="#" class="btn btn-primary float-right mb-4" data-toggle="modal" v-on:click.prevent="newAttention()">Nueva Atención</a>
        @endcan
        <div class="form-inline mr-4 mb-4 float-right" >
            <input class="form-control mr-sm-2" type="text" v-model="search">
            <button class="btn btn-primary" v-on:click.prevent="searchAttention()" type="button">Buscar</button>
        </div>
        <table class="table table-hover table-striped mt-4">
            <thead>
                <tr>
                    <th class="text-center">Nro Historia Clinica</th>
                    <th class="text-center">Apellido</th>
                    <th class="text-center">Motivo</th>
                    <th class="text-center">Diagnostico</th>
                    <th class="text-center">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="a in attentions">
                    <td class="text-center">@{{ a.patient_chn}}</td>
                    <td class="text-center">@{{ a.patient_surname }}</td>
                    <td class="text-center">@{{ a.reason }}</td>
                    <td class="text-center">@{{ a.diagnostic }}</td>
                    <td class="text-center">@{{ a.date }}</td>
                    @can('attention_show')
                        @include('guardTeamUser.attention.details')
                        <td width="10px">
                            <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="detailsAttention(a)">Detalles</a>
                        </td>
                    @endcan
                    @can('attention_update')
                        @include('guardTeamUser.attention.edit')
                        <td width="10px">
                            <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editAttention(a)">Editar</a>
                        </td>
                    @endcan
                    @can('attention_destroy')
                        @include('guardTeamUser.attention.delete')
                        <td width="10px">
                            <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="destroyAttention(a)">Eliminar</a>
                        </td>
                @endcan
                </tr>
            </tbody>
        </table>
        @include('pagination')
    </div>
</div>
@endsection