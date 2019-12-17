@extends("layout.layout")

@section('title_system')
{{$custom_config['title_system']['title_system']}}
@endsection

@section('title_nav')
{{$custom_config['title_nav']['title_nav']}}
@endsection

@section('content')
<div id="patient-crud" class="row mt-4">
	<div class="col-sm-12">
		<h1 class="page-header">Gestión de Pacientes</h1>
	</div>
    <div class="col-sm-12">
        @can('patient_new')
            @include('guardTeamUser.patient.create')
            <a href="#" class="btn btn-primary float-right mb-4" data-toggle="modal" v-on:click.prevent="createPatient()">Nuevo Paciente</a>
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
                <tr v-for="p in filteredPatients">
                    <td class="text-center">@{{ p.document_number }}</td>
                    <td class="text-center">@{{ p.name }}</td>
                    <td class="text-center">@{{ p.surname }}</td>
                    @can('patient_show')
                        @include('guardTeamUser.patient.details')
                        <td width="10px">
                            <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="detailsPatient(p)">Detalles</a>
                        </td>
                    @endcan
                    @can('patient_update')
                        @include('guardTeamUser.patient.edit')
                        <td width="10px">
                            <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editPatient(p)">Editar</a>
                        </td>
                    @endcan
                    @can('patient_destroy')
                        @include('guardTeamUser.patient.delete')
                        <td width="10px">
                            <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deletePatient(p)">Eliminar</a>
                        </td>
                    @endcan
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection