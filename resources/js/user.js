import Axios from "axios";
import toastr from "toastr";
import swal from "sweetalert";

new Vue({
    el: '#user-crud',
    data: {
        state: false,
        id:'',
        email: '',
        password: '',
        name: '',
        surname: '',
        repeat_password: '',
        users: [],
        user_show: {
            'email': '',
            'name': '',
            'surname': '',
            'state': '',
        },
        user_edit: {
            'id': '',
            'email': '',
            'name': '',
            'surname': '',
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
        //details
        detailsUser: function(user){
            this.user_show.email = user.email;
            this.user_show.name = user.name;
            this.user_show.surname = user.surname;
            if (user.active == 1){
                this.user_show.state = 'activo';
            }else{
                this.user_show.state = 'inactivo';
            }
            $('#details').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        },

        //delete
        destroyUser: function(user){
            this.id = user.id;
            $('#delete').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        },
        deleteUser: function(){
            axios.post('/admin/users/delete', {
                'id': this.id
            })
            .then(response =>{
                this.id = '';
                this.getUsers();
                $('#delete').modal('hide');
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

       //update 
       //refactoring!!
        editUser: function(user){
            //show
            this.user_edit.id = user.id;
            this.user_edit.email = user.email;
            this.user_edit.name = user.name;
            this.user_edit.surname = user.surname;
            if (user.active == 1){
                this.state = true;
                this.user_edit.active = 1;
            }else{
                this.state = false;
                this.user_edit.active = 0;
            }
            $('#edit').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        },
        updateUser: function(){
            if (this.state) { 
                this.user_edit.active = 1;
            } else {
                this.user_edit.active = 0;
            }
            axios.put('/admin/users/update', this.user_edit)
            .then(response =>{
                //console.log(response.data);
                this.getUsers();
                this.user_edit = {
                    'id': '',
                    'email': '',
                    'active': '',
                    'name': '',
                    'surname': '',
                };
                $('#edit').modal('hide');
                toastr.success('Actualizado correctamente');
            }).catch(error => {
                let err = error.response.data.errors;
                let message = 'error no identificado';
                
                if (err.hasOwnProperty('active')){
                    message = err.active[0];
                }else if(err.hasOwnProperty('name')){
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

        //create
        newUser : function(){
            this.email =  '';
            this.password = '';
            this.repeat_password = '';
            this.name = '';
            this.surname = '';
            $('#create').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        },
        createUser: function(){
            if (this.password == this.repeat_password){
                axios.post('/admin/users/create', {
                    email : this.email,
                    repeat_password: this.repeat_password,
                    password: this.password,
                    active: 1,
                    name : this.name,
                    surname: this.surname
                }).then(response =>{
                    //console.log(response.data);
                    this.getUsers();
                    this.email =  '';
                    this.password = '';
                    this.repeat_password = '';
                    this.name = '';
                    this.surname = '';
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
                    }else if(err.hasOwnProperty('name')){
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