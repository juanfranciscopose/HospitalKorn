new Vue({
    el: '#attention-crud',
    data: {
        attentions: [],
        date: '',
        diagnostic: '',
        patient_id: '',
        patient_chn: '',
        patient_surname: '',
        attentionEdit: {
            'date': '',
            'patient_surname': '',
            'patient_chn': '',
            'patient_id': '',
            'diagnostic': ''
        }
    },
    created: function() {
        this.getAttentions();
    },
    methods: {
        getAttentions: function (){
            axios.get('/attentions/all')
            .then(response => {
                this.attentions = response.data;
                console.log(response.data);
            });
        },
    }
});