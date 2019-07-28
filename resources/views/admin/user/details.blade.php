<div class="modal fade" id="details">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
            <div class="modal-header">
                <h4>Usuario</h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" v-model="userShow.email" disabled>
                </div>
                <div class="form-group">
                    <label for="state">Estado</label>
                    <input type="text" name="state" class="form-control" v-model="userShow.state" disabled>
                </div>
            </div>  
            </form>
        </div>
    </div>
</div>