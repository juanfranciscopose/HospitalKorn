<div class="modal fade" id="details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Nro Historia Clínica: @{{patientShow.clinical_history_number}} </h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <ul >
                    <li>Nombre y Apellido: @{{patientShow.name}} @{{patientShow.surname}}</li>
                    <li>Fecha de Nacimiento: @{{ patientShow.birthdate}}</li>
                    <li>Partido: @{{ patientShow.party}}</li>
                    <li>Localidad: @{{ patientShow.town}}</li>
                    <li>Dirección: @{{ patientShow.address}}</li>
                    <li>Género: @{{ patientShow.selected_gender}}</li>
                    <li>Tipo de Documento: @{{ patientShow.document_type}}</li>
                    <li>Número de Documento: @{{ patientShow.document_number}}</li>
                    <li>Obra Social: @{{ patientShow.social_work}}</li>
                    <li>Número de Carpeta: @{{ patientShow.folder_number}}</li>
                </ul>
            </div>  
        </div>
    </div>
</div>