@extends("layout.layout")

@section('title_system')
{{$custom_config['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$custom_config['title_nav']['title_nav']}}
@endsection

@section('content')
<div id="attention-crud" class="row mt-4">
	<div class="col-sm-12">
		<h1 class="page-header">Atención al Paciente</h1>
	</div>
    <div class="col-sm-12">
        @can('attention_new')
            @include('guardTeamUser.attention.create')
            <a href="#" class="btn btn-primary float-right" data-toggle="modal" v-on:click.prevent="newAttention()">Nueva Atención</a>
        @endcan
        <table class="table table-hover table-striped mt-4">
            <thead>
                <tr>
                    <th class="text-center">Nro Historia Clínica</th>
                    <th class="text-center">Nombre Paciente</th>
                    <th class="text-center">diagnostico</th>
                    <th class="text-center">fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="a in attentions">
                    <td class="text-center">@{{ a.patient.clinical_history_number }}</td>
                    <td class="text-center">@{{ a.patient.surname }}</td>
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
    </div>
</div>
@endsection