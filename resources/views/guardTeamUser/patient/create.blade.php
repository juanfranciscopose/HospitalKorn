<div class="modal text-dark fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
            <div class="modal-header">
                <h4>Nuevo Paciente</h4> 
                <button type="button" class="ml-5 btn btn-info" v-on:click="createPatientNN()">Nuevo NN</button>             
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="chNumber">Nro Historia Clínica<b class="text-danger">*</b></label>
                    <input v-if="!status_nn"  type="number" name="chNumber" class="form-control" v-model="chn" required>
                    <input v-else type="number" name="chNumber" class="form-control" v-model="patient_nn.clinical_history_number" required>
                </div>
                <div class="form-group">
                    <label for="geneder">Género<b class="text-danger">*</b></label>
                    <select v-if="!status_nn" v-model="selected_gender" name="gender" required>
                        <option v-for="g in gender">@{{g}}</option>
                    </select>
                    <select v-else v-model="selected_gender" name="gender" disabled>
                        <option v-for="g in gender">@{{g}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nombre<b class="text-danger">*</b></label>
                    <input v-if="!status_nn" type="text" name="name" class="form-control" v-model="name" required>
                    <input v-else type="text" name="name" class="form-control" v-model="name" disabled>
                </div>
                <div class="form-group">
                    <label for="surname">Apellido<b class="text-danger">*</b></label>
                    <input v-if="!status_nn" type="text" name="surname" class="form-control" v-model="surname" required>
                    <input v-else type="text" name="surname" class="form-control" v-model="surname" disabled>
                </div>
                <div class="form-group">
                    <label for="birthdate">Fecha de Nacimiento<b class="text-danger">*</b></label>
                    <input v-if="!status_nn" type="date" name="birthdate" class="form-control" v-model="birthdate" required>
                    <input v-else type="date" name="birthdate" class="form-control" v-model="birthdate" disabled>
                </div>
                <div class="form-group">
                    <label for="party">Partido<b class="text-danger">*</b></label>
                    <select v-if="!status_nn" v-model="selected_party" name="party" v-on:change.prevent="regionOf()" required>
                        <option v-for="p in parties" v-bind:value="p.id">@{{ p.nombre }}</option>
                    </select>
                    <select v-else v-model="selected_party" name="party" v-on:change.prevent="regionOf()" disabled>
                        <option v-for="p in parties" v-bind:value="p.id">@{{ p.nombre }}</option>
                    </select>
                    <div class="container">
                        <p>Región Sanitaria: @{{ region.nombre }}</p>
                    </div>    
                </div>
                <div class="form-group">
                    <label for="town">Localidad<b class="text-danger">*</b></label>
                    <select v-if="!status_nn" v-model="selected_town" name="town" required>
                        <option v-for="t in towns" v-bind:value="t.id">@{{ t.nombre }}</option>
                    </select>  
                    <select v-else v-model="selected_town" name="town" disabled>
                        <option v-for="t in towns" v-bind:value="t.id">@{{ t.nombre }}</option>
                    </select> 
                </div>
                <div class="form-group">
                    <label for="address">Dirección<b class="text-danger">*</b></label>
                    <input v-if="!status_nn" type="text" name="address" class="form-control" v-model="address" required>
                    <input v-else type="text" name="address" class="form-control" v-model="address" disabled>
                </div>
                <div class="form-group">
                    <label for="document_type">Tipo de Documento<b class="text-danger">*</b></label>
                    <select v-if="!status_nn" v-model="selected_document_type" name="document_type" required>
                        <option v-for="dt in document_types" v-bind:value="dt.id">@{{ dt.nombre }}</option>
                    </select>  
                    <select v-else v-model="selected_document_type" name="document_type" disabled>
                        <option v-for="dt in document_types" v-bind:value="dt.id">@{{ dt.nombre }}</option>
                    </select>  
                </div>
                <div class="form-group">
                    <label for="document_number">Número de Documento<b class="text-danger">*</b></label>
                    <input v-if="!status_nn" type="number" name="document_number" class="form-control" v-model="document_number" required>
                    <input v-else type="number" name="document_number" class="form-control" v-model="document_number" disabled>
                </div>
                <div class="form-group">
                    <label for="folder_number">Número de Carpeta</label>
                    <input v-if="!status_nn" type="number" name="folder_number" class="form-control" v-model="folder_number">
                    <input v-else type="number" name="folder_number" class="form-control" v-model="folder_number" disabled>
                </div>
                <div class="form-group">
                    <label for="telephone">Teléfono</label>
                    <input v-if="!status_nn" type="number" name="telephone" class="form-control" v-model="telephone">
                    <input v-else type="number" name="telephone" class="form-control" v-model="telephone" disabled>
                </div>
                <div class="form-group">
                    <label for="social_work">Obra social</label>
                    <select v-if="!status_nn" v-model="selected_social_work" name="social_work">
                        <option v-for="sw in social_works" v-bind:value="sw.id">@{{ sw.nombre }}</option>
                    </select>
                    <select v-else v-model="selected_social_work" name="social_work" disabled>
                        <option v-for="sw in social_works" v-bind:value="sw.id">@{{ sw.nombre }}</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <small>Nota: los campos que tienen (*) son obligatorios.</small> 
                <button v-if="!status_nn" type="button" class="btn btn-info" v-on:click="storePatient()">Guardar</button>
                <button v-else type="button" class="btn btn-info" v-on:click="storePatientNN()">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>