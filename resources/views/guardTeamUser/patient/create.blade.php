
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" v-on:click="createPatient()">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>