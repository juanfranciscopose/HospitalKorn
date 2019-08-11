<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
            <div class="modal-header">
                <h4>Editar Usuario</h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" v-model="user_edit.name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Apellido</label>
                    <input type="text" name="surname" class="form-control" v-model="user_edit.surname" required>
                </div>
                <div class="form-group">
                    <label for="state">Estado</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input id="state" class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">Usuario Activo</label>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-on:click="updateUser()">Actualizar</button>
            </div>
            </form>
        </div>
    </div>
</div>