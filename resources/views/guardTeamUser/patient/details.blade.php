<div class="modal fade" id="details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Nro Historia Clínica: @{{patient_show.clinical_history_number}} </h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <ul >
                    <li>Nombre y Apellido: @{{patient_show.name}} @{{patient_show.surname}}</li>
                    <li>Tipo de Documento: @{{ patient_show.document_type}}</li>
                    <li>Número de Documento: @{{ patient_show.document_number}}</li>
                    <li>Fecha de Nacimiento: @{{ patient_show.birthdate}}</li>
                    <li>Partido: @{{ patient_show.party}}</li>
                    <li>Localidad: @{{ patient_show.town}}</li>
                    <li>Dirección: @{{ patient_show.address}}</li>
                    <li>Género: @{{ patient_show.selected_gender}}</li>

                    <li v-if="patient_show.social_work === null">Obra Social: No posee</li>
                    <li v-else>Obra Social: @{{ patient_show.social_work}}</li>

                    <li v-if="patient_show.telephone === null">Teléfono: No posee</li>
                    <li v-else>Teléfono: @{{ patient_show.telephone}}</li>

                    <li v-if="patient_show.folder_number === null">Número de Carpeta: No posee</li>
                    <li v-else>Número de Carpeta: @{{ patient_show.folder_number}}</li>
                </ul>
            </div>  
        </div>
    </div>
</div>