import Axios from "axios";
import toastr from "toastr";
import swal from "sweetalert";

new Vue({
    el: '#user-crud',
    data: {
        email: '',
        password: '',
        repeat_password: '',
        users: [],
        userShow: {
            'email': '',
            'state': '',
        },
        userEdit: {
            'id': '',
            'email': '',
            'active': ''
        }
    },
    created: function() {
        this.getUsers();
    },
    methods: {
        getUsers: function (){
            axios.get('/admin/users/all')
            .then(response => {
                this.users = response.data;
            });
        },
        detailsUser: function(user){
            this.userShow.email = user.email;
            if (user.active == 1){
                this.userShow.state = 'activo';
            }else{
                this.userShow.state = 'inactivo';
            }
            $('#details').modal('show');
        },
        deleteUser: function(user){
            axios.post('/admin/users/delete', {
                'id': user.id
            })
            .then(response =>{
                this.getUsers();
                toastr.success('Eliminado correctamente');
            })
            .catch(error => {
                let err = error.response.data.errors;
                let message = 'error no identificado';
                
                if(err.hasOwnProperty('delete')){
                    message = err.delete[0];
                }
                swal({
                    title: 'Error',
                    text: message,
                    icono: 'error',
                    closeOnClickOutside: false
                });
            });
        },
        editUser: function(user){
            //show
            this.userEdit.id = user.id;
            this.userEdit.email = user.email;
            if (user.active == 1){
                $("input[id=state]").prop("checked", true);
            }else{
                $("input[id=state]").prop("checked", false);
            }
            $('#edit').modal('show');
        },
        updateUser: function(){
            if ($("input[id=state]").is(':checked')) { 
                this.userEdit.active = 1;
            } else {
                this.userEdit.active = 0;
            }
            axios.put('/admin/users/update', this.userEdit)
            .then(response =>{
                //console.log(response.data);
                this.getUsers();
                this.userEdit = {
                    'id': '',
                    'email': '',
                    'active': ''
                };
                $('#edit').modal('hide');
                toastr.success('Actualizado correctamente');
            }).catch(error => {
                let err = error.response.data.errors;
                let message = 'error no identificado';
                
                if (err.hasOwnProperty('active')){
                    message = err.active[0];
                }
                swal({
                    title: 'Error',
                    text: message,
                    icono: 'error',
                    closeOnClickOutside: false
                });
            });
        },
        createUser: function(){
            if (this.password == this.repeat_password){
                axios.post('/admin/users/create', {
                    email : this.email,
                    repeat_password: this.repeat_password,
                    password: this.password,
                    active: 1
                }).then(response =>{
                    //console.log(response.data);
                    this.getUsers();
                    this.email =  '';
                    this.password = '';
                    this.repeat_password = ''; 
                    $('#create').modal('hide');
                    toastr.success('Creado correctamente');
                }).catch(error => {
                    //refactoring
                    let err = error.response.data.errors;
                    let message = 'error no identificado';
                    
                    if(err.hasOwnProperty('email')){
                        message = err.email[0];
                    }else if (err.hasOwnProperty('password')){
                        message = err.password[0];
                    }else if(err.hasOwnProperty('active')){
                        message = err.active[0];
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
            }else{
                swal({
                    title: 'Error',
                    text: 'error en las contraseñas',
                    icono: 'error',
                    closeOnClickOutside: false
                });
            }
            
        }
    }
});