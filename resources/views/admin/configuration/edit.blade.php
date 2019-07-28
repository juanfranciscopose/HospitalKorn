        <div class="modal fade" id="edit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST">
                        <div class="modal-header">
                            <h4>@{{configEdit.name}}</h4> 
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>                       
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="description">@{{configEdit.description}}</label>
                                <input type="text" name="surname" class="form-control" v-model="configEdit.value" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" v-on:click="updateConfig()">Actualizar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>