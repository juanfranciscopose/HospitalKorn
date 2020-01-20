import Axios from "axios";
import toastr from "toastr";
import swal from "sweetalert";

new Vue({
    el: '#user-crud',
    data: {
        status_search: false,
        search: '', 
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
        },
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
        },
        offset: 3
    },
    created: function() {
        this.getUsers();
    },
    computed: {
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
        //refactoring!! 
        showAssignRoles: function (){
            window.location.href = '/admin/role';
        },
        getUsers: function (page){
            this.status_search= false;
            axios.get('/admin/users/all?page='+page)
            .then(response => {
                this.users = response.data.list.data;
                this.pagination = response.data.pagination;
            });
        },
        searchUser: function (page){
            if (this.search == ''){
                this.getUsers();
            }else{
                this.status_search = true;
                axios.get('/admin/users/search?search='+this.search+'&page='+page)
                .then(response => {
                    this.users = response.data.list.data;
                    this.pagination = response.data.pagination;
                });
            }
        },
        //pagination
        changePage: function (page){
            this.pagination.current_page = page;
            if (this.status_search == false){
                this.getUsers(page);
            }else{
                this.searchUser(page);
            }
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