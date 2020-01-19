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
<div class="container container-main mt-4 mb-5">
    <div class="shadow bg-white pr-3 pl-3 pb-3 pt-3">
        <div>
            <h1>Instituciones Hospitalarias</h1>
            <hr>
        </div>
        <div id="search-institutions">
            <div class="row">
                <div class="col-sm-12 mb-4">
                    <label for="party"><strong>Partido:</strong></label>
                    <select v-model="selected" name="party" v-on:change.prevent="regionOf()">
                        <option v-for="p in parties" v-bind:value="p.id">@{{ p.nombre }}</option>
                    </select>
                    <p><strong>Región Sanitaria:</strong> @{{ region.nombre }}</p>
                    <button class="btn-info" v-on:click.prevent="listInstitutions()" type="button">Buscar</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nombre institucion</th>
                            <th>Director</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="i in  institutions">
                            <td>@{{i.name}}</td>
                            <td>@{{i.director}}</td>
                            <td>@{{i.telephone}}</td>
                            @include('institution.details')
                            <td width="10px">
                                <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="detailsInstitution(i)"><i style="font-size:19px" class="fa fa-ellipsis-h"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection