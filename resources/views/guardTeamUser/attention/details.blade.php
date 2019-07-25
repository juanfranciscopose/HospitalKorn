<div class="modal fade" id="details">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                <div class="modal-header">
                    <h4>Paciente</h4> 
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>                       
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="patient">Nombre Paciente</label>
                        <input type="text" name="patient" class="form-control" v-model="attentionShow.name_surname_patient" disabled>
                    </div>
                    <div class="form-group">
                        <label for="diagnostic">Diagnóstico</label>
                        <input type="text" name="diagnostic" class="form-control" v-model="attentionShow.diagnostic" disabled>
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha</label>
                        <input type="date" name="date" class="form-control" v-model="attentionShow.date" disabled>
                    </div>
                </div>  
                </form>
            </div>
        </div>
    </div>