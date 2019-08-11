import Axios from "axios";
import toastr from "toastr";
import swal from "sweetalert";


//patient code
new Vue({
    //element DOM (id)
    el: '#patient-crud',
    //form model data
    data: {
        id:'',
        gender: ['MASCULINO', 'FEMENINO', 'TRANS', 'OTROS'],
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
        patient_show: {
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
            'social_work': [],
        }
    },
    created: function() {
        this.getPatients();
    },
    methods: {
        getPatients: function (){
            axios.get('/patients/all')
            .then(response => {
                this.patients = response.data;
            });
        },

        //create
        createPatient: function(){
            this.setPartiesWithAll();
            this.setSocialWorksWithAll();
            this.setDocumentTypesWithAll();
            this.chn =  '';
            this.name = '';
            this.surname = ''; 
            this.birthdate = '';
            this.selected_party = [];
            this.region = [];
            this.towns = [];
            this.selected_town = '';
            this.address = '';
            this.selected_gender = '';
            this.selected_document_type = '';
            this.document_number = '';
            this.folder_number = '';
            this.telephone = '';
            this.selected_social_work = '';
            $('#create').modal('show');
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
        setPartiesWithAll: function(){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/partido')
            .then(response => {
                this.parties = response.data;
            });
        },

        //edit
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
        setSanitaryRegion: function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/region-sanitaria/'+id)
            .then(response => {
              this.region = response.data;
            });
        },
        editPatient: function(patient){
            this.patient_edit.clinical_history_number = patient.clinical_history_number;
            this.patient_edit.name = patient.name;
            this.patient_edit.surname = patient.surname;
            this.patient_edit.birthdate = patient.birthdate;
            this.patient_edit.address = patient.address;
            this.patient_edit.telephone = patient.telephone;
            this.patient_edit.document_number = patient.document_number;
            this.patient_edit.folder_number = patient.folder_number;
            this.patient_edit.town = patient.town;
            this.patient_edit.party = patient.party;
            this.patient_edit.gender = patient.gender;
            this.patient_edit.document_type = patient.document_type;
            this.patient_edit.social_work = patient.social_work;
            this.getAllTownsByParty(patient.town);
            this.setSanitaryRegion(patient.party);
            this.setPartiesWithAll();
            this.setDocumentTypesWithAll();
            this.setSocialWorksWithAll();
            $('#edit').modal('show');
        },
        updatePatient: function(){
            axios.put('/patients/update', this.patientEdit)
            .then(response =>{
                this.getPatients();
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
            axios.post('/patients/delete', {
                'id': this.id
            })
            .then(response =>{
                this.id = '';
                this.getPatients();
                $('#deleted').modal('hide');
                toastr.success('Eliminado correctamente');
            });
        },
        deletePatient: function(patient){
            this.id = patient.id;
            $('#deleted').modal('show');
        },

        // Show details
        setPatientShowTownName: function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/localidad/'+id)
            .then(response => {
                this.patient_show.town = response.data.nombre;
            });
        },
        setPatientShowPartyName: function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/partido/'+id)
            .then(response => {
                this.patient_show.party = response.data.nombre;
            });
        },
        setPatientShowDocumentTypeName: function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/tipo-documento/'+id)
            .then(response => {
                this.patient_show.document_type = response.data.nombre;
            });
        },
        setPatientShowSocialWorkName: function(id){
            axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/obra-social/'+id)
            .then(response => {
                this.patient_show.social_work = response.data.nombre;
            });
        },
        detailsPatient: function(patient){
            this.patient_show.name = patient.name;
            this.patient_show.surname = patient.surname;
            this.patient_show.clinical_history_number = patient.clinical_history_number;
            this.patient_show.birthdate = patient.birthdate;
            this.patient_show.address = patient.address;
            this.patient_show.telephone = patient.telephone;
            this.patient_show.document_number = patient.document_number;
            this.patient_show.folder_number = patient.folder_number;
            this.setPatientShowTownName(patient.town);
            this.setPatientShowPartyName(patient.party);
            this.patient_show.selected_gender = patient.gender;
            this.setPatientShowDocumentTypeName(patient.document_type);
            if(patient.social_work == null){
                this.patient_show.social_work = null;
            }else{
                this.setPatientShowSocialWorkName(patient.social_work);
            }
            $('#details').modal('show');
        }
    }
});