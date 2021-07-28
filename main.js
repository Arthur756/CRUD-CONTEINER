var app = new Vue({
    el: '#app',
    data: {
        errorMsg: "",
        successMsg: "",
        showAddModal: false,
        showEditModal: false,
        showDeleteModal: false,
        cliente: [],
        newCliente: {name:"",nconteiner:"",tipo:"",
        status:"",categoria:"",movimentacao:"",dta_inicio:"",dta_fim:""},
        currentCliente: {}
    },
    mounted: function(){
        this.getAllClientes();
    },
    methods: {
        getAllClientes(){
            axios.get("https://localhost/crud-vue-sql/process.php?action=read").then(function(response){
            if(response.data.error){
                app.errorMsg = response.data.message;
            }
            else{
                app.cliente = response.data.cliente;
            }
            });
        },
        addCliente(){
            var formData = app.toFormData(app.newCliente);
            axios.post("https://localhost/crud-vue-sql/process.php?action=create", formData).then(function(response){
                app.newCliente = {name:"", nconteiener:"", tipo:"", status:"",
            categoria:"", movs:"", dta_inicio:"", dta_fim:""};
                if(response.data.error){
                    app.errorMsg = response.data.message;
                }
                else{
                    app.successMsg = response.data.message;
                    app.getAllClientes();
                }
                });
        },
        updateCliente(){
            var formData = app.toFormData(app.currentCliente);
            axios.post("https://localhost/crud-vue-sql/process.php?action=update", formData).then(function(response){
                app.currentCliente = {};
                if(response.data.error){
                    app.errorMsg = response.data.message;
                }
                else{
                    app.successMsg = response.data.message;
                    app.getAllClientes();
                }
                });
        },
        deleteCliente(){
            var formData = app.toFormData(app.currentCliente);
            axios.post("https://localhost/crud-vue-sql/process.php?action=delete", formData).then(function(response){
                app.currentCliente = {};
                if(response.data.error){
                    app.errorMsg = response.data.message;
                }
                else{
                    app.successMsg = response.data.message;
                    app.getAllClientes();
                }
                });
        },
        toFormData(obj){
            var fd = new FormData();
            for(var i in obj){
                fd.append(i,obj[i]);
            }
            return fd;
        },
        selectCliente(client){
            app.currentCliente = client;
        }
        
    }
    
});