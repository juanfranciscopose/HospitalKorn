import swal from "sweetalert";
import Axios from "axios";
import toastr from "toastr";

new Vue({
    el: '#attention-crud',
    data: {
        attentions: [],
        date: '',
        diagnostic: '',
        patient_id: '',
        patient_chn: '',
        attentionEdit: {
            'id': '',
            'date': '',
            'patient_id': '',
            'diagnostic': ''
        },
        attentionShow: {
            'id': '',
            'date': '',
            'patient_id': '',
            'name_surname_patient': '',
            'diagnostic': ''
        }
    },
    created: function() {
        this.getAttentions();
    },
    methods: {
        getAttentions: function (){
            axios.get('/attentions/all')
            .then(response => {
                this.attentions = response.data;
                //console.log(response.data);
            });
        },
        getPatientData: function(){
            if (this.patient_id != ''){
                axios.get('/patients/patient/'+this.patient_id)
                .then(response => {
                    //console.log(response.data);
                    if(response.data == 'No hay paciente con ese ID'){
                        $('#patientData').html(response.data);
                    }else{
                        $('#patientData').html(response.data.name +' '+response.data.surname);
                    }
                });
            }else{
                $('#patientData').html('');
            }
        },
        createAttention: function(){
            axios.post('/attentions/create', {
                diagnostic : this.diagnostic,
                date: this.date,
                patient_id: this.patient_id
            }).then(response =>{
                //console.log(response.data);
                this.getAttentions();
                this.diagnostic =  '';
                this.date = '';
                this.patient_id = ''; 
                $('#patientData').html('');
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
        deleteAttention: function(attention){
            axios.post('/attentions/delete', {
                'id': attention.id
            })
            .then(response =>{
                this.getAttentions();
                toastr.success('Eliminado correctamente');
            });
        },
        editAttention: function(attention){
            //show
            this.attentionEdit.id = attention.id;
            this.attentionEdit.date = attention.date;
            this.attentionEdit.diagnostic = attention.diagnostic;
            this.attentionEdit.patient_id = attention.patient_id;
            $('#edit').modal('show');
        },
        updateAttention: function(){
            axios.put('/attentions/update', this.attentionEdit)
            .then(response => {
                console.log(response.data);
                this.getAttentions();
                this.attentionEdit = {
                    'id': '',
                    'date': '',
                    'diagnostic': '',
                    'patient_id': ''
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
        detailsAttention: function(attention){
            axios.get('/patients/patient/'+attention.patient_id)
            .then(response => {               
                this.attentionShow.name_surname_patient = response.data.name +' '+response.data.surname;
            });
            this.attentionShow.id = attention.id;
            this.attentionShow.diagnostic = attention.diagnostic;
            this.attentionShow.date = attention.date;
            this.attentionShow.patient_id = attention.patient_id;
            $('#details').modal('show');
        }
    }
});
