@extends("layout.layout")

@section('content')
<div id="attention-crud" class="row mt-4">
	<div class="col-sm-12">
		<h1 class="page-header">Atención al Paciente</h1>
	</div>
    <div class="col-sm-12">
        <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#create" data-backdrop="static" data-keyboard="false">Nueva Atención</a>
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
                    <td width="10px">
                        <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="detailsAttention(a)">Detalles</a>
                    </td>
                    <td width="10px">
                        <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editAttention(a)">Editar</a>
                    </td>
                    <td width="10px">
                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteAttention(a)">Eliminar</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @include('guardTeamUser.attention.create')
    @include('guardTeamUser.attention.edit')
    @include('guardTeamUser.attention.details')
</div>
@endsection