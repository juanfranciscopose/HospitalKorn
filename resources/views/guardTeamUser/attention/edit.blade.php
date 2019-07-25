
        <div class="modal fade" id="edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                    <div class="modal-header">
                        <h4>Editar Atención</h4> 
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>                       
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="diagnostic">Diagnostico</label>
                            <input type="text" name="diagnostic" class="form-control" v-model="attentionEdit.diagnostic" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Fecha</label>
                            <input type="date" name="date" class="form-control" v-model="attentionEdit.date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" v-on:click="updateAttention()">Actualizar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>