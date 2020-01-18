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
<div id="attention">

    <div class="row bg-dark text-white section-nav">
        <div class="col-sm-6">
            <h3 class="ml-4 mt-2 pt-1 pb-1 page-header">Atención al Paciente</h3>
        </div>
        <div class="col-sm-6">
            <ul class="mr-4 navbar-nav navbar-expand-lg justify-content-end">
                <li class="nav-item">
                    <div class="pt-1 pb-1 mr-4 mt-2">
                        @can('attention_new')
                        @include('guardTeamUser.attention.create')
                        <button href="#" class="button-dark-nav float-right" data-toggle="modal" v-on:click.prevent="newAttention()">Nueva Atención</button>
                    @endcan
                    </div>
                </li>
                <li class="nav-item form-inline float-right">
                    <div class="pt-1 pb-1 mt-2 mr-4">
                        <input class="form-control mr-sm-2" type="text" v-model="search">
                        <button class="button-dark-nav" v-on:click.prevent="searchAttention()" type="button">Buscar</button>        
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
        
        </div>
    </div>

</div>
@endsection