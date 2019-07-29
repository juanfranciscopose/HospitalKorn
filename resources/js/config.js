import Axios from "axios";
import toastr from "toastr";
import swal from "sweetalert";
new Vue({
    el: '#config',
    data: {
        configs: [],
        editMode: false,
    },
    created: function() {
        this.getConfig();
    },
    methods: {
        getConfig: function (){
            axios.get('/admin/config/all')
            .then(response => {
                this.configs = response.data;
            });
        },
        editConfig: function (){
            this.editMode = true;
        },
        updateConfig: function(){
            axios.put('/admin/config/update', this.configs)
            .then(response =>{
                this.getConfig();
                this.editMode = false;
                toastr.success('Actualizado correctamente');
            });            
        }
    }
});