<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
            <div class="modal-header">
                <h4>Editando Rol de: @{{ user_edit.email }}</h4>                   
            </div>
            <div class="modal-body">
                <div v-for="role in roles" :key="role.id">
                    <label>@{{role.name}}</label>
                    <input type="radio" v-model="user_edit.roles" name="role" :value="role"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-on:click="updateRole()">Actualizar</button>
                <button type="button" class="btn btn-danger" v-on:click="cancelUpdateRole()">cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>