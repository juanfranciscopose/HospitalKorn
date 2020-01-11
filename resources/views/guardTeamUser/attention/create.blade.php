<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
            <div class="modal-header">
                <h4>Nueva Atención</h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>  
            </div>
            <div class="modal-body"> 
                <div class="form-group">
                    <label for="idPatient">ID paciente<b class="text-danger">*</b></label>
                    <input type="number" name="idPatient" id= "idPatient" class="form-control" v-model="patient_id" v-on:change.prevent="getPatientData()" required>
                    <div class="container">
                        <label for="p">Nombre del paciente</label>
                        <b><div class="container panel" id="patientData">@{{patient_data}}</div></b>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Fecha<b class="text-danger">*</b></label>
                    <input type="date" name="date" class="form-control" v-model="date" required>
                </div>
                <div class="form-group">
                    <label for="reason">Motivo<b class="text-danger">*</b></label>
                    <select v-model="selected_reason" name="reason">
                        <option v-for="rc in reasons_consultation">@{{rc}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="derivation">Derivación</label>
                    <select v-model="selected_derivation" name="derivation">
                        <option v-for="d in derivation" v-bind:value="d.id">@{{ d.name }}</option>
                    </select>  
                </div>
                <div class="form-group">
                    <label for="articulation">Articulación</label>
                    <input type="text" name="articulation" class="form-control" v-model="articulation">
                </div>
                <div class="form-group">
                    <label for="internment">Internación</label>
                    <div class="container">
                        <div class="form-group">
                            <div class="form-check">
                                <input id="internment" v-model="selected_internment" class="form-check-input" type="checkbox" id="gridCheck" >
                                <label class="form-check-label" for="gridCheck">Necesita internación</label>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="form-group">
                    <label for="name">Diagnóstico<b class="text-danger">*</b></label>
                    <input type="text" name="diagnostic" class="form-control" v-model="diagnostic" required>
                </div>
                <div class="form-group">
                    <label for="pharmacotherapy">Tratamiento farmacológico</label>
                    <select v-model="selected_pharmacotherapy" name="pharmacotherapy">
                        <option v-for="p in pharmacotherapy">@{{p}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="observations">Observaciones</label>
                    <input type="text" name="observations" class="form-control" v-model="observations">
                </div>
                <div class="form-group">
                    <label for="accompaniment">Acompañamiento</label>
                    <select v-model="selected_accompaniment" name="accompaniment">
                        <option v-for="a in accompaniment">@{{a}}</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <small>Nota: los campos que tienen (*) son obligatorios.</small> 
                <button type="button" class="btn btn-primary" v-on:click="createAttention()">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>