import Axios from "axios";
new Vue({
    el: '#user-crud',
    //form model data
    data: {
        users: []
    },
    created: function() {
        this.getUsers();
    },
    methods: {
        getUsers: function (){
            axios.get('/admin/users/all')
            .then(response => {
                this.users = response.data;
                //console.log(response.data);
            });
        },
    }
});