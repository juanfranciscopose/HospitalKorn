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
                            <label for="idPatient">ID paciente</label>
                            <input type="number" name="idPatient" id= "idPatient" class="form-control" v-model="patient_id" v-on:keyup.prevent="getPatientData()" required>
                            <div class="container panel" id="patientData"> </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Diagnóstico</label>
                            <input type="text" name="diagnostic" class="form-control" v-model="diagnostic" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Fecha</label>
                            <input type="date" name="date" class="form-control" v-model="date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" v-on:click="createAttention()">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>