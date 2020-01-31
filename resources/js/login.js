import Axios from "axios";
import swal from "sweetalert";

//login code
new Vue({
    //element DOM (id)
    el: '#login-form',
    //form model data
    data: {
        email: '',
        password:''
    },
    methods: {
        sendLogin: function(){
            axios.post('/login', {
                email: this.email,
                password: this.password
            }).then(select => {
                window.location.href = '/articles';
            })
            .catch(error => {
                let err = error.response.data.errors;
                let message = 'error no identificado';
                
                if(err.hasOwnProperty('email')){
                    message = err.email[0];
                }else if (err.hasOwnProperty('password')){
                    message = err.password[0];
                }else if(err.hasOwnProperty('login')){
                    message = err.login[0];
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