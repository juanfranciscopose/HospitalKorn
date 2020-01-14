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
        status_search: false,
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
        },
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
        },
        offset: 3,
    },
    created: function() {
        this.getAttentions();
    },
    computed:{
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function (){
            if (!this.pagination.to){
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1){
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        searchAttention: function (page){
            if (this.search == ''){
                this.getAttentions();
            }else{
                this.status_search = true;
                axios.get('/attentions/search?search='+this.search+'&page='+page)
                .then(response => {
                    this.attentions = response.data.list.data;
                    this.pagination = response.data.pagination;
                });
            }
        },
        //pagination
        changePage: function (page){
            this.pagination.current_page = page;
            if (this.status_search == false){
                this.getAttentions(page);
            }
            else{
                this.searchAttention(page);
            }
            
        },
        //called in creation
        getAttentions: function(page){
            this.status_search= false;
            axios.get('/attentions/all?page='+page)
            .then(response => {
                this.attentions = response.data.list.data;
                this.pagination = response.data.pagination;               
            });
        },
        getAllDerivation: function(){
            //getAllInstitutions
            axios.get('/institutions/all')
            .then(response => {
                this.derivation = response.data;
            });
        },
        getPatientData: function(){
            if (this.patient_id != ''){
                axios.get('/patients/'+this.patient_id)
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
                this.getAttentions();
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
