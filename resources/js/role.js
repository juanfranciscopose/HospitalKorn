import Axios from "axios";
import toastr from "toastr";
import swal from "sweetalert";
new Vue({
    el: '#role',
    data: {
        roles: [],
        users: [],
        user_edit: {
            'user_id': '',
            'email': '',
            'roles': '',
            'roles_names': ''
        },
    },
    created: function() {
        this.getRoles();
        this.getUsersWithRoles();
    },
    methods: {
        getUsersWithRoles: function (){
            axios.get('/admin/role/users/all')
            .then(response => {
                this.users = response.data;
            });
        },
        getRoles: function (){
            axios.get('/admin/role/all')
            .then(response => {
                this.roles = response.data;
            });
        },
        cancelUpdateRole: function (){
            this.user_edit.email = '';
            this.user_edit.user_id = '';
            this.user_edit.roles = '';
            this.user_edit.roles_names = '';
            $('#edit').modal('hide');
        },
                //refactoring!!!
        editRole: function (user){
            this.user_edit.email = user.email;
            this.user_edit.user_id = user.user_id;
            for (var i = 0; i < this.roles.length; i++){
                if (this.roles[i].id == user.role_id){
                    this.user_edit.roles = this.roles[i];
                }
            }
            $('#edit').modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });
        },
        updateRole: function(){
            this.user_edit.roles_names = this.user_edit.roles.name;
            
            axios.put('/admin/role/update', this.user_edit)
            .then(response =>{
                this.user_edit.email = '';
                this.user_edit.user_id = '';
                this.user_edit.roles = '';
                this.user_edit.roles_names = '';
                this.getRoles();
                this.getUsersWithRoles();
                toastr.success('Actualizado correctamente');
                $('#edit').modal('hide');
            });     
        }
    }
});