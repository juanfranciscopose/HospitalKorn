<div class="modal fade" id="details">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Paciente: @{{ attention_show.name_surname_patient}}</h4> 
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>                       
                </div>
                <div class="modal-body">
                    <li class="list-group">Fecha: @{{ attention_show.date}}</li>
                    <li class="list-group">Motivo: @{{ attention_show.reason}}</li>
                    <li class="list-group">Diagnostico: @{{ attention_show.diagnostic}}</li>
                    
                    <li v-if="attention_show.pharmacotherapy === null" class="list-group">Tratamiento farmacológico: No posee</li>
                    <li v-else class="list-group">Tratamiento farmacológico: @{{ attention_show.pharmacotherapy}}</li>
                    
                    <li v-if="attention_show.articulation === null" class="list-group">Articulación: No posee</li>
                    <li v-else class="list-group">Articulación: @{{ attention_show.articulation}}</li>

                    <li v-if="attention_show.derivation === null" class="list-group">Derivación: No posee</li>
                    <li v-else class="list-group">Derivación: @{{ attention_show.derivation}}</li>
                    
                    <li v-if="attention_show.observation === null" class="list-group">Observación: No posee</li>
                    <li v-else class="list-group">Observación: @{{ attention_show.observation}}</li>

                    <li v-if="attention_show.internment === 1" class="list-group">Internación: si</li>
                    <li v-else class="list-group">Internación: no</li>

                    <li v-if="attention_show.accompaniment === null" class="list-group">Acompañante: No posee</li>
                    <li v-else class="list-group">Acompañante: @{{attention_show.accompaniment}}</li>

                </div>  
            </div>
        </div>
    </div>