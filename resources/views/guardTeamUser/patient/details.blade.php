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
                    <li class="list-group">Nombre y Apellido: @{{patient_show.name}} @{{patient_show.surname}}</li>
                    <li class="list-group">Tipo de Documento: @{{ patient_show.document_type}}</li>
                    <li class="list-group">Número de Documento: @{{ patient_show.document_number}}</li>
                    <li class="list-group">Fecha de Nacimiento: @{{ patient_show.birthdate}}</li>
                    <li class="list-group">Partido: @{{ patient_show.party}}</li>
                    <li class="list-group">Localidad: @{{ patient_show.town}}</li>
                    <li class="list-group">Dirección: @{{ patient_show.address}}</li>
                    <li class="list-group">Género: @{{ patient_show.selected_gender}}</li>

                    <li class="list-group" v-if="patient_show.social_work === null">Obra Social: No posee</li>
                    <li class="list-group" v-else>Obra Social: @{{ patient_show.social_work}}</li>

                    <li class="list-group" v-if="patient_show.telephone === null">Teléfono: No posee</li>
                    <li class="list-group" v-else>Teléfono: @{{ patient_show.telephone}}</li>

                    <li class="list-group" v-if="patient_show.folder_number === null">Número de Carpeta: No posee</li>
                    <li class="list-group" v-else>Número de Carpeta: @{{ patient_show.folder_number}}</li>
                </ul>
            </div>  
        </div>
    </div>
</div>