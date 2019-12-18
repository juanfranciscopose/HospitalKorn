import swal from "sweetalert";
import Axios from "axios";
import toastr from "toastr";

new Vue({
    el: '#attention',
    data: {
        id: '',
        patient_data: '',
        accompaniment: ['Familiar cercano', 'Hermanos e hijos', 'Pareja', 'Referentes vinculares', 'Policía', 'SAME', 'Por sus propios medios'],
        reasons_consultation: ['Receta médica', 'Control de guardia', 'Consulta', 'Intento de suicidio', 'Interconsulta', 'Otras'],
        pharmacotherapy: ['Mañana', 'Tarde', 'Noche'],
        selected_accompaniment: '',
        selected_reason: '',
        selected_pharmacotherapy: '',
        articulation: '',
        internment: 0,
        observations: '',
        attentions: [],
        patients: [],
        date: '',
        diagnostic: '',
        patient_id: '',
        patient_chn: '',
        derivation: [],
        selected_derivation: '',
        selected_internment: false,
        search: '',
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
    created: function() {
        this.getPatientsWithAttentions();
        this.getAttentions();
    },
    computed:{
        filteredAttentions: function(){
            return this.attentions.filter((a) => {
                return ((a.reason.match(this.search)) || (a.diagnostic.match(this.search)) || (a.patient.surname.match(this.search)) || (this.search.match(a.patient.clinical_history_number)));
            });
        }
    },
    methods: {
        getAttentions: function(){
            axios.get('/attentions/all')
            .then(response => {
                this.attentions = response.data;
                for (var a of this.attentions ) {
                    for (var p of this.patients ) {
                        if (p.id == a.patient_id) {
                            a.patient = p;
                        }
                    };
                };                
            });
        },
        getAllDerivation: function(){
            //getAllInstitutions
            axios.get('/institutions/all')
            .then(response => {
                this.derivation = response.data;
            });
        },
        getPatientsWithAttentions: function (){
            axios.get('/patients/attentions/all')
            .then(response => {
                this.patients = response.data;
                //console.log(response);
            });
        },
        getPatientData: function(){
            if (this.patient_id != ''){
                axios.get('/patients/patient/'+this.patient_id)
                .then(response => {
                    if(response.data == 'No hay paciente con ese ID'){
                        this.patient_data = response.data;
                    }else{
                        this.patient_data = response.data.name + ' ' + response.data.surname;
                    }
                });
            }else{
                this.patient_data = '';
            }
        },
        // create attention
        newAttention: function(){
            this.patient_data = '';
            this.selected_accompaniment= '';
            this.selected_reason= '';
            this.selected_pharmacotherapy= '';
            this.selected_internment= false;
            this.articulation= '';
            this.internment= 0;
            this.observations= '';
            this.date= '';
            this.diagnostic= '';
            this.patient_id= '';
            this.selected_derivation = '';
            this.getAllDerivation();
            $('#create').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        },
        createAttention: function(){
            if (this.selected_internment) { 
                this.internment = 1;
            }else{
                this.internment = 0;
            }
            axios.post('/attentions/create', {
                diagnostic : this.diagnostic,
                date: this.date,
                patient_id: this.patient_id,
                internment: this.internment,
                accompaniment: this.selected_accompaniment,
                reason: this.selected_reason,
                pharmacotherapy: this.selected_pharmacotherapy,
                articulation: this.articulation,
                observation: this.observations,
                derivation: this.selected_derivation
            }).then(response =>{
                this.getPatientsWithAttentions();
                this.patient_data = '';
                this.selected_accompaniment= '';
                this.selected_reason= '';
                this.selected_pharmacotherapy= '';
                this.articulation= '';
                this.internment= 0;
                this.selected_internment= false;
                this.observations= '';
                this.date= '';
                this.diagnostic= '';
                this.patient_id= '';
                this.selected_derivation = '';
                $('#create').modal('hide');
                toastr.success('Creado correctamente');
            }).catch(error => {
                //refactoring
                let err = error.response.data.errors;
                let message = 'error no identificado';
                
                if(err.hasOwnProperty('patient_id')){
                    message = err.patient_id[0];
                }else if (err.hasOwnProperty('date')){
                    message = err.date[0];
                }else if(err.hasOwnProperty('diagnostic')){
                    message = err.diagnostic[0];
                }else if(err.hasOwnProperty('store')){
                    message = err.store[0];
                }
                swal({
                    title: 'Error',
                    text: message,
                    icono: 'error',
                    closeOnClickOutside: false
                });
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
