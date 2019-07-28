import Axios from "axios";
new Vue({
    el: '#user-crud',
    data: {
        users: [],
        userShow: {
            'email': '',
            'state': '',
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
        }
    }
});