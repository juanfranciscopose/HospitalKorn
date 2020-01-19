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

@section('content')
<div class="container container-main mt-5 mb-5">
    <div class="row ">
    
        <div class="col-sm-12 col-md-4 ">
            <div class="bg-white rounded border pb-3">
                <img class="img-fluid border-0 rounded-top" src="{{url('img/doctor.jpg')}}" alt="doctor">
                <h2 class="mt-2 text-center">Capacitación</h2>
                <div class="p-3">
                    <p class="text-justify">Se invita al personal de la Institución a la capacitación de Bioseguridad Hospitalaria sobre
                    "Segregación de Residuos" que se llevará a cabo el día Martes 10 de Abril a las 10 hs en el aula
                    de Bioseguridad e Higiene (ex SAC). La misma estará a cargo del Licenciado Juan Aranciaga,
                    de la firma Lancef.</p>
                    <div class="text-center"> 
                        <button class="btn btn-info" type="button" name="button">Ver Detalles >></button> 
                    </div> 
                </div>
            </div>
        </div>
    
        <div class="col-sm-12 col-md-4 ">
            <div class="bg-white rounded border pb-3">
                <img class="img-fluid border-0 rounded-top" src="{{url('img/hospital.jpg')}}" alt="doctor">
                <h2 class="mt-2 text-center">Horario de visitas</h2>
                <div class="p-3">
                    <p class="text-justify">Se informa a la comunidad que el horario de visitas en el área de 
                        Partos es de 11 a 12 y de 15 a 17 horas. En tanto para visitar a personas 
                        internadas en sala de Clínica Médica y de Cirugía, el horario es de 16 a 17,30. 
                        En la Guardia es de 12,30 a 13 horas y en Terapia Intensiva, de 18,30 a 19 horas.</p>
                    <div class="text-center"> 
                        <button class="btn btn-info" type="button" name="button">Ver Detalles >></button> 
                    </div>   
                </div>
            </div>
        </div>
    
        <div class="col-sm-12 col-md-4 ">
            <div class="bg-white rounded border pb-3">
                <img class="img-fluid border-0 rounded-top" src="{{url('img/nurse.jpeg')}}" alt="doctor">
                <h2 class="mt-2 text-center">Jornadas</h2>
                <div class="p-3">
                    <p class="text-justify" >Invitamos a todos los actores institucionales del hospital a 
                        participar de las próximas Jornadas Multidisciplinarias a realizarse en el mes de 
                        Octubre. Los interesados deben contactarse con el Servicio de Docencia de Investigación 
                        para proponer el tema elegido y conocer cuáles son los requisitos para la presentación 
                        de los trabajos.</p>
                    <div class="text-center"> 
                        <button class="btn btn-info" type="button" name="button">Ver Detalles >></button> 
                    </div> 
                </div>
            </div>
        </div>
    
    </div>
</div>
@endsection