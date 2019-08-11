<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
            <div class="modal-header">
                <h4>Nuevo Paciente</h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="chNumber">Nro Historia Clínica</label>
                    <input type="number" name="chNumber" class="form-control" v-model="chn" required>
                </div>
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" v-model="name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Apellido</label>
                    <input type="text" name="surname" class="form-control" v-model="surname" required>
                </div>
                <div class="form-group">
                    <label for="birthdate">Fecha de Nacimiento</label>
                    <input type="date" name="birthdate" class="form-control" v-model="birthdate" required>
                </div>
                <div class="form-group">
                    <label for="party">Partido</label>
                    <select v-model="selected_party" name="party" v-on:change.prevent="regionOf()">
                        <option v-for="p in parties" v-bind:value="p.id">@{{ p.nombre }}</option>
                    </select>
                    <div class="container">
                        <p>Región Sanitaria: @{{ region.nombre }}</p>
                    </div>    
                </div>
                <div class="form-group">
                    <label for="town">Localidad</label>
                    <select v-model="selected_town" name="town">
                        <option v-for="t in towns" v-bind:value="t.id">@{{ t.nombre }}</option>
                    </select>  
                </div>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control" v-model="address" required>
                </div>
                <div class="form-group">
                    <label for="geneder">Género</label>
                    <select v-model="selected_gender" name="gender">
                        <option v-for="g in gender">@{{g}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="document_type">Tipo de Documento</label>
                    <select v-model="selected_document_type" name="document_type">
                        <option v-for="dt in document_types" v-bind:value="dt.id">@{{ dt.nombre }}</option>
                    </select>  
                </div>
                <div class="form-group">
                    <label for="document_number">Número de Documento</label>
                    <input type="number" name="document_number" class="form-control" v-model="document_number">
                </div>
                <div class="form-group">
                    <label for="folder_number">Número de Carpeta</label>
                    <input type="number" name="folder_number" class="form-control" v-model="folder_number">
                </div>
                <div class="form-group">
                    <label for="telephone">Teléfono</label>
                    <input type="number" name="telephone" class="form-control" v-model="telephone">
                </div>
                <div class="form-group">
                    <label for="social_work">Obra social</label>
                    <select v-model="selected_social_work" name="social_work">
                        <option v-for="sw in social_works" v-bind:value="sw.id">@{{ sw.nombre }}</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-on:click="storePatient()">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>