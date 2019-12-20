import Axios from "axios";
import toastr from "toastr";

new Vue({
    el: '#change-pass',
    data: {
        repeat_password: '',
        change:{
            'password':'' 
        }
    },

    methods: {
        savePass: function (){
           if (this.repeat_password == this.change.password){
                axios.put('/users/password/update', this.change)
                .then(response => {
                    this.repeat_password = '';
                    this.change.password = '';
                    toastr.success('Actualizado correctamente');
                });
           }
        }
    }
});
