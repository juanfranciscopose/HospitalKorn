import Axios from "axios";
import toastr from "toastr";
import swal from "sweetalert";
new Vue({
    el: '#config',
    data: {
        configs: [],
        editMode: false,
        selected_enable :'',
    },
    created: function() {
        this.getConfig();
    },
    methods: {
        getConfig: function (){
            axios.get('/admin/config/all')
            .then(response => {
                this.configs = response.data;
                if (this.configs.enable.enable == 1){
                    this.selected_enable = true;
                }else{
                    this.selected_enable = false;
                }
            });
        },
        editConfig: function (){
            this.editMode = true;
        },
        updateConfig: function(){
            if (this.selected_enable){
                this.configs.enable.enable = 1;
            }else{
                this.configs.enable.enable = 0;
            }
            axios.put('/admin/config/update', this.configs)
            .then(response =>{
                this.getConfig();
                this.editMode = false;
                toastr.success('Actualizado correctamente');
            });            
        }
    }
});