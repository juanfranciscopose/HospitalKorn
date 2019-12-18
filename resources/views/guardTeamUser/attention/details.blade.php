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
                    <li>Fecha: @{{ attention_show.date}}</li>
                    <li>Motivo: @{{ attention_show.reason}}</li>
                    <li>Diagnostico: @{{ attention_show.diagnostic}}</li>
                    
                    <li v-if="attention_show.pharmacotherapy === null">Tratamiento farmacológico: No posee</li>
                    <li v-else>Tratamiento farmacológico: @{{ attention_show.pharmacotherapy}}</li>
                    
                    <li v-if="attention_show.articulation === null">Articulación: No posee</li>
                    <li v-else>Articulación: @{{ attention_show.articulation}}</li>

                    <li v-if="attention_show.derivation === null">Derivación: No posee</li>
                    <li v-else>Derivación: @{{ attention_show.derivation}}</li>
                    
                    <li v-if="attention_show.observation === null">Observación: No posee</li>
                    <li v-else>Observación: @{{ attention_show.observation}}</li>

                    <li v-if="attention_show.internment === 1">Internación: si</li>
                    <li v-else>Internación: no</li>

                    <li v-if="attention_show.accompaniment === null">Acompañante: No posee</li>
                    <li v-else>Acompañante: @{{attention_show.accompaniment}}</li>

                </div>  
            </div>
        </div>
    </div>