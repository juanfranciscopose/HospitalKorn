<div class="modal text-dark fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
            <div class="modal-header">
                <h4>Nuevo Usuario</h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" v-model="email" required>
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
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" class="form-control" v-model="password" required>
                </div>
                <div class="form-group">
                    <label for="pass2">Repetir Contraseña</label>
                    <input type="password" name="pass2" class="form-control" v-model="repeat_password" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-on:click="createUser()">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>