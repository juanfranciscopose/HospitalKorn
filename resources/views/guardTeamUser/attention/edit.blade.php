<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
            <div class="modal-header">
                <h4>Editar Atención </h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="date">Fecha</label>
                    <input type="date" name="date" class="form-control" v-model="attention_edit.date" required>
                </div>
                <div class="form-group">
                    <label for="reason">Motivo</label>
                    <select v-model="attention_edit.reason" name="reason">
                        <option v-for="rc in reasons_consultation" :selected="attention_edit.reason === rc">@{{rc}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="derivation">Derivación</label>
                    <select v-model="attention_edit.derivation" name="derivation">
                        <option v-for="d in derivation" v-bind:value="d.id" :selected="d.id === attention_edit.derivation">@{{ d.name }}</option>
                    </select>  
                </div>
                <div class="form-group">
                    <label for="articulation">Articulación</label>
                    <input type="text" name="articulation" class="form-control" v-model="attention_edit.articulation">
                </div>
                <div class="form-group">
                    <label for="internment">Internación</label>
                    <div class="container">
                        <div class="form-group">
                            <div class="form-check">
                                <input id="internment" v-model="selected_internment" class="form-check-input" type="checkbox" id="gridCheck" :checked="selected_internment">
                                <label class="form-check-label" for="gridCheck">Necesita internación</label>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="form-group">
                    <label for="name">Diagnóstico</label>
                    <input type="text" name="diagnostic" class="form-control" v-model="attention_edit.diagnostic" required>
                </div>
                <div class="form-group">
                    <label for="pharmacotherapy">Tratamiento farmacológico</label>
                    <select v-model="attention_edit.pharmacotherapy" name="pharmacotherapy">
                        <option v-for="p in pharmacotherapy" :selected="attention_edit.pharmacotherapy === p">@{{p}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="observations">Observaciones</label>
                    <input type="text" name="observations" class="form-control" v-model="attention_edit.observations">
                </div>
                <div class="form-group">
                    <label for="accompaniment">Acompañamiento</label>
                    <select v-model="attention_edit.accompaniment" name="accompaniment">
                        <option v-for="a in accompaniment" :selected="attention_edit.accompaniment === a">@{{a}}</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-on:click="updateAttention()">Actualizar</button>
            </div>
            </form>
        </div>
    </div>
</div>