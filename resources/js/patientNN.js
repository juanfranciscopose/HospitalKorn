import Axios from "axios";
import toastr from "toastr";
import swal from "sweetalert";


new Vue({
    el: '#patientNN',
    data: {
        id:'',
        gender: ['MASCULINO', 'FEMENINO', 'TRANS', 'OTROS'],
        chn: '',
        name: '',
        surname: '',
        birthdate: '',
        parties: [],
        region:[],
        selected_party: '',
        towns: [],
        selected_town: '',
        address: '',
        selected_gender: '',
        document_types: [],
        document_number:'',
        selected_document_type: '',
        folder_number: '',
        telephone: '',
        social_works: [],
        selected_social_work: '',
        search: '',
        status_search: false,
        patientsNN: [],
        patient_edit: {
            'clinical_history_number': '',
            'name': '',
            'surname': '',
            'birthdate': '',
            'address': '',
            'document_number': '',
            'folder_number': '',
            'telephone': '',
            'town': '',
            'party':'',
            'gender': '',
            'document_type': '',
            'social_work': ''
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
        this.getPatientsNN();
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
        searchPatientNN: function (page){
            if (this.search == ''){
                this.getPatientsNN();
            }else{
                this.status_search = true;
                axios.get('/patientsNN/search?search='+this.search+'&page='+page)
                .then(response => {
                    this.patientsNN = response.data.list.data;
                    this.pagination = response.data.pagination;
                });
            }
        },

        //pagination
        changePage: function (page){
            this.pagination.current_page = page;
            if (this.status_search == false){
                this.getPatientsNN(page);
            }
            else{
                this.searchPatientNN(page);
            }
            
        },
        getPatientsNN: function (page){
            this.status_search= false;
            axios.get('/patientsNN/all?page='+page)
            .then(response => {
                this.patientsNN = response.data.list.data;
                this.pagination = response.data.pagination;
            });
        },
        EditRegionOf : function(){
            if (this.patient_edit.party == ''){
                this.region = [];
            }else{
                var sr = this.parties[this.patient_edit.party-1].region_sanitaria_id;
                axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/region-sanitaria/'+sr)
                .then(response => {
                  this.region = response.data;
                  this.getAllTownsByParty(sr);
                });
            }
        },
        editPatientNN: function (patient){
            this.patient_edit.clinical_history_number = patient.clinical_history_number;
            this.setPartiesWithAll();
            this.setDocumentTypesWithAll();
            this.setSocialWorksWithAll();
            $('#edit').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        },
        setSocialWorksWithAll : function(){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/obra-social')
            .then(response => {
                this.social_works = response.data;
            });
        },
        setDocumentTypesWithAll: function(){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/tipo-documento')
            .then(response => {
                this.document_types = response.data;
            });
        },
        setSanitaryRegion: function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/region-sanitaria/'+id)
            .then(response => {
              this.region = response.data;
            });
        },
        getAllTownsByParty : function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/localidad/partido/'+id)
            .then(response => {
              this.towns = response.data;
            });
        },
        setPartiesWithAll: function(){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/partido')
            .then(response => {
                this.parties = response.data;
            });
        },
        updatePatient: function (p){
            axios.put('/patientsNN/update', this.patient_edit)
            .then(response =>{
                this.getPatientsNN();
                this.patient_edit = {
                    'clinical_history_number': '',
                    'name': '',
                    'surname': '',
                    'birthdate': '',
                    'address': '',
                    'document_number': '',
                    'folder_number': '',
                    'telephone': '',
                    'town': '',
                    'party':'',
                    'gender': '',
                    'document_type': '',
                    'social_work': ''
                };
                this.parties = [];
                this.region = [];
                this.towns = [];
                this.document_types = [];
                this.social_works = [];
                $('#edit').modal('hide');
                toastr.success('Actualizado correctamente');
            }).catch(error => {
                let err = error.response.data.errors;
                let message = 'error no identificado';
                
                if (err.hasOwnProperty('name')){
                    message = err.name[0];
                }else if(err.hasOwnProperty('surname')){
                    message = err.surname[0];
                }else if(err.hasOwnProperty('birthdate')){
                    message = err.birthdate[0];
                }else if(err.hasOwnProperty('party')){
                    message = err.party[0];
                }else if(err.hasOwnProperty('town')){
                    message = err.town[0];
                }else if(err.hasOwnProperty('address')){
                    message = err.address[0];
                }else if(err.hasOwnProperty('gender')){
                    message = err.gender[0];
                }else if(err.hasOwnProperty('document_type')){
                    message = err.document_type[0];
                }else if(err.hasOwnProperty('update')){
                    message = err.update[0];
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
        destroyPatient: function(){
            axios.post('/patientsNN/delete', {
                'id': this.id
            })
            .then(response =>{
                this.id = '';
                this.getPatientsNN();
                $('#delete').modal('hide');
                toastr.success('Eliminado correctamente');
            });
        },
        deletePatientNN: function(patient){
            this.id = patient.id;
            $('#delete').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        },
    }
});