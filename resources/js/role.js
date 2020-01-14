import Axios from "axios";
import toastr from "toastr";

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
        search: '',
        status_search: false,
        offset: 3,
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
        }
    },
    created: function() {
        this.getRoles();
        this.getUsersWithRoles();
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
        getUsersWithRoles: function (page){
            this.status_search= false;
            axios.get('/admin/role/users/all?page='+page)
            .then(response => {
                this.users = response.data.list.data;
                this.pagination = response.data.pagination;
            });
        },
        searchUserRole: function (page){
            if (this.search == ''){
                this.getUsersWithRoles();
            }else{
                this.status_search = true;
                axios.get('/admin/role/users/search?search='+this.search+'&page='+page)
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
                this.getUsersWithRoles(page);
            }else{
                this.searchUserRole(page);
            }
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