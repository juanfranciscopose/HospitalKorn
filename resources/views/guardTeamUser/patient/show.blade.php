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
<div id="patient-crud">

    <div class="row bg-dark text-white section-nav">
        <div class="col-sm-6">
            <h3 class="ml-4 mt-2 pt-1 pb-1 page-header">Gestión de Pacientes</h3>
        </div>
        <div class="col-sm-6">
            <ul class="mr-4 navbar-nav navbar-expand-lg justify-content-end">
                <li class="nav-item">
                    <div class="pt-1 pb-1 mr-4 mt-2">
                        @can('patient_new')
                            @include('guardTeamUser.patient.create')
                            <button href="#" class="button-dark-nav float-right " data-toggle="modal" v-on:click.prevent="createPatient()">Nuevo Paciente</button>
                        @endcan
                    </div>
                </li>
                <li class="nav-item form-inline float-right">
                    <div class="pt-1 pb-1 mt-2 mr-4">
                        <input placeholder="buscar..." class="form-control" type="text" v-model="search">
                        <button class="button-dark-nav" v-on:click.prevent="searchPatient()" type="button"><i class="fa fa-search"></i></button>
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
                                <th class="text-center">Nro Documento</th>
                                <th class="text-center">Nro de Historia Clínica</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Apellido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="p in patients">
                                <td class="text-center">@{{ p.document_number }}</td>
                                <td class="text-center">@{{ p.clinical_history_number }}</td>
                                <td class="text-center">@{{ p.name }}</td>
                                <td class="text-center">@{{ p.surname }}</td>
                                @can('patient_show')
                                    @include('guardTeamUser.patient.details')
                                    <td width="10px">
                                        <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="detailsPatient(p)"><i style="font-size:19px" class="fa fa-ellipsis-h"></i></a>
                                    </td>
                                @endcan
                                @can('patient_update')
                                    @include('guardTeamUser.patient.edit')
                                    <td width="10px">
                                        <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="editPatient(p)"><i style="font-size:19px" class="fa fa-pencil"></i></a>
                                    </td>
                                @endcan
                                @can('patient_destroy')
                                    @include('guardTeamUser.patient.delete')
                                    <td width="10px">
                                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deletePatient(p)"><i style="font-size:19px" class="fa fa-trash-o"></i></a>
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