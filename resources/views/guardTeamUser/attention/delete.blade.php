<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirmar Borrado</h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <p>¿Está seguro?</p>
            </div>  
            <div class="modal-footer"> 
                <button type="button" class="btn btn-danger" v-on:click.prevent="deleteAttention()">Eliminar Atención</button>                      
            </div>
        </div>
    </div>
</div>