import swal from "sweetalert";
import Axios from "axios";
import toastr from "toastr";

new Vue({
    el: '#search-institutions',
    data: {
        parties: [],
        region: [],
        selected: 0,
        institutions:[],
        showInstitution: {
          name: '',
          address: '',
          sanitary_region_id: '',
          director: '',
          telephone: '',
          id: ''
        }
    },
    created: function() {
        this.getParties();
    },
    methods: {
        getParties: function (){
          axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/partido')
            .then(response => {
                this.parties = response.data;
                //console.log(response.data);
            });
        },
        regionOf: function(){
          if (this.selected == 0){
              this.region = [];
            }else{
              var sr = this.parties[this.selected-1].region_sanitaria_id;
              axios.get('https://api-referencias.proyecto2018.linti.unlp.edu.ar/region-sanitaria/'+sr)
              .then(response => {
                this.region = response.data;
                this.institutions = [];
              });
            }
        },
        listInstitutions: function(){
          var reg = this.region.id;
          axios.get('/institutions/sanitary_region/'+reg)
          .then(response => {
            this.institutions = response.data;
          }).catch(error => {
            let err = error.response.data.errors;
            let message = 'error no identificado';
            
            if(err.hasOwnProperty('getBySanitaryRegionId')){
                message = err.getBySanitaryRegionId[0];
            }
            swal({
                title: 'Error',
                text: message,
                icono: 'error',
                closeOnClickOutside: false
            });
          });
        },
        detailsInstitution: function(inst){
          console.log(inst);
          this.showInstitution.name = inst.name;
          this.showInstitution.address = inst.address;
          this.showInstitution.sanitary_region_id = inst.sanitary_region_id;
          this.showInstitution.director = inst.director;
          this.showInstitution.telephone = inst.telephone;
          this.showInstitution.id = inst.id;
          //aca mapa
          $('#details').modal('show');
        }
    }
});
