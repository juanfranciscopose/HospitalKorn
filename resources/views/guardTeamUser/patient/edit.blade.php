<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Editar Paciente</h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" v-model="patient_edit.name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Apellido</label>
                    <input type="text" name="surname" class="form-control" v-model="patient_edit.surname" required>
                </div>
                <div class="form-group">
                    <label for="document_type">Tipo de Documento</label>
                    <select v-model="patient_edit.document_type" name="document_type">
                        <option v-for="dt in document_types" v-bind:value="dt.id" :selected="dt.id === patient_edit.document_type">@{{ dt.nombre }}</option>
                    </select>  
                </div>
                <div class="form-group">
                    <label for="document_number">Número de Documento</label>
                    <input type="number" name="document_number" class="form-control" v-model="patient_edit.document_number" disabled>
                </div>
                <div class="form-group">
                    <label for="birthdate">Fecha de Nacimiento</label>
                    <input type="date" name="birthdate" class="form-control" v-model="patient_edit.birthdate" required>
                </div>
                <div class="form-group">
                    <label for="gender">Género</label>
                    <select v-model="patient_edit.gender" name="gender">
                        <option v-for="g in gender" :selected="g === patient_edit.gender">@{{g}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="party">Partido</label>
                    <select v-model="patient_edit.party" name="party" v-on:change.prevent="EditRegionOf()">
                        <option v-for="p in parties" v-bind:value="p.id" :selected="p.id === patient_edit.party">@{{ p.nombre }}</option>
                    </select>
                    <div class="container">
                        <p>Región Sanitaria: @{{ region.nombre }}</p>
                    </div>    
                </div>
                <div class="form-group">
                    <label for="town">Localidad</label>
                    <select v-model="patient_edit.town" name="town">
                        <option v-for="t in towns" v-bind:value="t.id" :selected="t.id === patient_edit.town">@{{ t.nombre }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control" v-model="patient_edit.address" required>
                </div>
                <div class="form-group">
                    <label for="social_work">Obra social</label>
                    <select v-model="patient_edit.social_work" name="social_work">
                        <option v-for="sw in social_works" v-bind:value="sw.id" :selected="sw.id === patient_edit.social_work">@{{ sw.nombre }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telephone">Teléfono</label>
                    <input type="text" name="telephone" class="form-control" v-model="patient_edit.telephone">
                </div>
                <div class="form-group">
                    <label for="folder_number">Número de Carpeta</label>
                    <input type="number" name="folder_number" class="form-control" v-model="patient_edit.folder_number">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" v-on:click="updatePatient()">Actualizar</button>
            </div>
        </div>
    </div>
</div>