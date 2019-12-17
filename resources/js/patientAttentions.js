import swal from "sweetalert";
import Axios from "axios";
import toastr from "toastr";

new Vue({
    el: '#patient_attentions',
    props:['patient'],
    data: {
        patient_id:'',
        id: '',
        accompaniment: ['Familiar cercano', 'Hermanos e hijos', 'Pareja', 'Referentes vinculares', 'Policía', 'SAME', 'Por sus propios medios'],
        reasons_consultation: ['Receta médica', 'Control de guardia', 'Consulta', 'Intento de suicidio', 'Interconsulta', 'Otras'],
        pharmacotherapy: ['Mañana', 'Tarde', 'Noche'],
        selected_accompaniment: '',
        selected_reason: '',
        selected_pharmacotherapy: '',
        attentions: [],
        derivation: [],
        selected_derivation: '',
        selected_internment: false,
        attention_edit: {
            'id': '',
            'date': '',
            'patient_id': '',
            'diagnostic': '',
            'internment': 0,
            'accompaniment': '',
            'reason': '',
            'pharmacotherapy': '',
            'articulation': '',
            'observation': '',
            'derivation': ''
        },
        attention_show: {
            'id': '',
            'date': '',
            'patient_id': '',
            'name_surname_patient': '',
            'diagnostic': '',
            'internment': 0,
            'accompaniment': '',
            'reason': '',
            'pharmacotherapy': '',
            'articulation': '',
            'observation': '',
            'derivation': ''
        }
    },
    methods: {
        getAllDerivation: function(){
            //getAllInstitutions
            axios.get('/institutions/all')
            .then(response => {
                this.derivation = response.data;
            });
        },
        //delete
        deleteAttention: function(){
            axios.post('/attentions/delete', {
                'id': this.id
            })
            .then(response =>{
                this.getAttentions();
                this.id = '';
                $('#delete').modal('hide');
                toastr.success('Eliminado correctamente');
            });
        },
        destroyAttention: function(Attention){
            this.id = Attention.id;
            $('#delete').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        },

        //edit
        editAttention: function(attention){
            this.attention_edit.id = attention.id;
            this.attention_edit.date = attention.date;
            this.attention_edit.diagnostic = attention.diagnostic;
            this.attention_edit.patient_id = attention.patient_id;
            this.attention_edit.accompaniment = attention.accompaniment;
            this.attention_edit.reason = attention.reason;
            this.attention_edit.pharmacotherapy = attention.pharmacotherapy;
            this.attention_edit.articulation = attention.articulation;
            this.attention_edit.observation = attention.observation;
            this.attention_edit.derivation = attention.derivation;
            this.attention_edit.internment = attention.internment;
            if(attention.internment == 1){
                this.selected_internment == true;
            }else{
                this.selected_internment == false;
            }
            this.getAllDerivation();
            $('#edit').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        },
        updateAttention: function(){
            if(this.selected_internment){
                this.attention_edit.internment = 1;
            }else{
                this.attention_edit.internment = 0;
            }
            axios.put('/attentions/update', this.attention_edit)
            .then(response => {
                this.getAttentions();
                this.attention_edit = {
                    'id': '',
                    'date': '',
                    'patient_id': '',
                    'diagnostic': '',
                    'internment': 0,
                    'accompaniment': '',
                    'reason': '',
                    'pharmacotherapy': '',
                    'articulation': '',
                    'observation': '',
                    'derivation': ''
                };
                $('#edit').modal('hide');
                toastr.success('Actualizado correctamente');
            }).catch(error => {
                let err = error.response.data.errors;
                let message = 'error no identificado';
                
                if (err.hasOwnProperty('date')){
                    message = err.date[0];
                }else if(err.hasOwnProperty('diagnostic')){
                    message = err.diagnostic[0];
                }else if(err.hasOwnProperty('id')){
                    message = err.id[0];
                }else if(err.hasOwnProperty('patient_id')){
                    message = err.patient_id[0];
                }
                swal({
                    title: 'Error',
                    text: message,
                    icono: 'error',
                    closeOnClickOutside: false
                });
            });
        },
        
        //details
        setAttentionShowDerivationName: function(id){
            axios.get('/institutions/'+id)
            .then(response => {
                this.attention_show.derivation = response.data.name;
            });
        },
        detailsAttention: function(attention){
            axios.get('/patients/patient/'+attention.patient_id)
            .then(response => {               
                this.attention_show.name_surname_patient = response.data.name +' '+response.data.surname;
            });
            this.attention_show.id = attention.id;
            this.attention_show.diagnostic = attention.diagnostic;
            this.attention_show.date = attention.date;
            this.attention_show.patient_id = attention.patient_id;
            this.attention_show.accompaniment = attention.accompaniment;
            this.attention_show.reason = attention.reason;
            this.attention_show.pharmacotherapy = attention.pharmacotherapy;
            this.attention_show.articulation = attention.articulation;
            this.attention_show.observation = attention.observation;
            if(attention.derivation == null){
                this.attention_show.derivation = null;
            }else{
                this.setAttentionShowDerivationName(attention.derivation);
            } 
            this.attention_show.internment = attention.internment;
            $('#details').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        }
    }
});
