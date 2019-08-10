import Axios from "axios";
import toastr from "toastr";
import swal from "sweetalert";


//patient code
new Vue({
    //element DOM (id)
    el: '#patient-crud',
    //form model data
    data: {
        patients: [],
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
        patientEdit: {
            'clinical_history_number': '',
            'name': '',
            'surname': ''
        },
        patientShow: {
            'clinical_history_number': '',
            'name': '',
            'surname': '',
            'birthdate': '',
            'address': '',
            'document_number': '',
            'folder_number': '',
            'telephone': '',
            'town': [],
            'party':[],
            'selected_gender': '',
            'document_type': [],
            'social_work': []
        }
    },
    created: function() {
        this.getPatients();
    },
    methods: {
        createPatient: function(){
            this.getAllParties();
            this.getAllSocialWorks();
            this.getAllDocumentTypes();
            $('#create').modal('show');
        },
        getAllSocialWorks : function(){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/obra-social')
            .then(response => {
                this.social_works = response.data;
            });
        },
        getAllDocumentTypes: function(){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/tipo-documento')
            .then(response => {
                this.document_types = response.data;
            });
        },
        storePatient: function(){
            axios.post('/patients/create', {
                clinical_history_number : this.chn,
                name: this.name,
                surname: this.surname,
                birthdate: this.birthdate,
                party: this.selected_party,
                town: this.selected_town,
                address: this.address,
                gender: this.selected_gender,
                document_type: this.selected_document_type,
                document_number: this.document_number,
                folder_number: this.folder_number,
                telephone: this.telephone,
                social_work: this.selected_social_work
            }).then(response =>{
                this.getPatients();
                this.chn =  '';
                this.name = '';
                this.surname = ''; 
                this.birthdate = '';
                this.selected_party = [];
                this.parties = [];
                this.region = [];
                this.towns = [];
                this.selected_town = '';
                this.address = '';
                this.selected_gender = '';
                this.document_types = [];
                this.selected_document_type = '';
                this.document_number = '';
                this.folder_number = '';
                this.telephone = '';
                this.social_works = [];
                this.selected_social_work = '';
                $('#create').modal('hide');
                toastr.success('Creado correctamente');
            }).catch(error => {
                //refactoring
                let err = error.response.data.errors;
                let message = 'error no identificado';
                
                if(err.hasOwnProperty('clinical_history_number')){
                    message = err.clinical_history_number[0];
                }else if (err.hasOwnProperty('name')){
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
                }else if(err.hasOwnProperty('document_number')){
                    message = err.document_number[0];
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
        regionOf : function(){
            if (this.selected_party == ''){
                this.region = [];
            }else{
                var sr = this.parties[this.selected_party-1].region_sanitaria_id;
                axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/region-sanitaria/'+sr)
                .then(response => {
                  this.region = response.data;
                  this.getAllTownsByParty(sr);
                });
            }
        },
        getAllTownsByParty : function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/localidad/partido/'+id)
            .then(response => {
              this.towns = response.data;
            });
        },
        getAllParties: function(){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/partido')
            .then(response => {
                this.parties = response.data;
            });
        },
        getPatients: function (){
            axios.get('/patients/all')
            .then(response => {
                this.patients = response.data;
            });
        },
        editPatient: function(patient){
            this.patientEdit.clinical_history_number = patient.clinical_history_number;
            this.patientEdit.name = patient.name;
            this.patientEdit.surname = patient.surname;
            $('#edit').modal('show');
        },
        updatePatient: function(){
            axios.put('/patients/update', this.patientEdit)
            .then(response =>{
                this.getPatients();
                this.patientEdit = {
                    'clinical_history_number': '',
                    'name': '',
                    'surname': ''
                };
                $('#edit').modal('hide');
                toastr.success('Actualizado correctamente');
            }).catch(error => {
                let err = error.response.data.errors;
                let message = 'error no identificado';
                
                if (err.hasOwnProperty('name')){
                    message = err.name[0];
                }else if(err.hasOwnProperty('surname')){
                    message = err.surname[0];
                }
                swal({
                    title: 'Error',
                    text: message,
                    icono: 'error',
                    closeOnClickOutside: false
                });
            });
        },
        deletePatient: function(patient){
            axios.post('/patients/delete', {
                'id': patient.id
            })
            .then(response =>{
                this.getPatients();
                toastr.success('Eliminado correctamente');
            });
        },
        getTownNameById: function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/localidad/'+id)
            .then(response => {
                this.patientShow.town = response.data.nombre;
            });
        },
        getPartyNameById: function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/partido/'+id)
            .then(response => {
                this.patientShow.party = response.data.nombre;
            });
        },
        getDocumentTypeNameById: function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/tipo-documento/'+id)
            .then(response => {
                this.patientShow.document_type = response.data.nombre;
            });
        },
        getSocialWorkNameById: function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/obra-social/'+id)
            .then(response => {
                this.patientShow.social_work = response.data.nombre;
            });
        },
        detailsPatient: function(patient){
            this.patientShow.name = patient.name;
            this.patientShow.surname = patient.surname;
            this.patientShow.clinical_history_number = patient.clinical_history_number;
            this.patientShow.birthdate = patient.birthdate;
            this.patientShow.address = patient.address;
            this.patientShow.telephone = patient.telephone;
            this.patientShow.document_number = patient.document_number;
            this.patientShow.folder_number = patient.folder_number;
            this.getTownNameById(patient.town);
            this.getPartyNameById(patient.party);
            this.patientShow.selected_gender = patient.gender;
            this.getDocumentTypeNameById(patient.document_type);
            this.getSocialWorkNameById(patient.social_work);
            $('#details').modal('show');
        }
    }
});