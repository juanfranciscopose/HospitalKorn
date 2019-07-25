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
                    <label for="chNumber">Nro Historia Clínica</label>
                    <input type="number" name="chNumber" class="form-control" v-model="patientShow.clinical_history_number" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" v-model="patientShow.name" disabled>
                </div>
                <div class="form-group">
                    <label for="surname">Apellido</label>
                    <input type="text" name="surname" class="form-control" v-model="patientShow.surname" disabled>
                </div>
            </div>  
            </form>
        </div>
    </div>
</div>