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
        patientEdit: {
            'clinical_history_number': '',
            'name': '',
            'surname': ''
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
                //console.log(response.data);
            });
        },
        editPatient: function(p){
            //show
            this.patientEdit.clinical_history_number = p.clinical_history_number;
            this.patientEdit.name = p.name;
            this.patientEdit.surname = p.surname;
            $('#edit').modal('show');
        },
        updatePatient: function(){
            axios.put('/patients/update', this.patientEdit)
            .then(response =>{
                //console.log(response.data);
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
        deletePatient: function(p){
            //console.log(p.clinical_history_number);
            axios.post('/patients/delete', {
                'id': p.id
            })
            .then(response =>{
                this.getPatients();
                toastr.success('Eliminado correctamente');
            });
        },
        createPatient: function(){
            axios.post('/patients/create', {
                clinical_history_number : this.chn,
                name: this.name,
                surname: this.surname
            }).then(response =>{
                //console.log(response.data);
                this.getPatients();
                this.chn =  '';
                this.name = '';
                this.surname = ''; 
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
        }
    }
});