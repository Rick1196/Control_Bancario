<template>
    <div>
         <div class="columns is-centered" style="padding: 2rem">
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <div class="content">
                        <div class="section">
                            <center>
                                <table class="table">
                                    <thead>
                                        <th><abbr title="#">#</abbr></th>
                                        <th><abbr title="Folio"></abbr></th>
                                        <th><abbr title="Saldo">Saldo</abbr></th>
                                        <th><abbr title="Transaccion">Transaccion</abbr></th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(cu,num) in lista">
                                            <th>{{num}}</th>
                                            <th>{{cu.folio}}</th>
                                            <th>{{cu.saldo}}</th>
                                            <th><button class="button is-link is-rounded" v-on:click="transaccion(cu.folio)">Transaccion</button></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <div class="column">
                <div class="card">
                    <div class="card-content">
                       <a class="button is-large is-fullwidth" v-on:click="createPDF">Obtener valance de cuentas</a>
                    </div>
                </div>
        </div>
    </div>
    <div class="modal is-active" v-if="modal_trans">
        <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                <p class="modal-card-title">Transaccion</p>
                <button class="delete" v-on:click="limpiaModal" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <div class="section">
                        <center>
                            <div class="field has-addons">
                                <div class="control">
                                    <input class="input" v-model="transaccion_info.destino" type="text" placeholder="Folio">
                                </div>
                                <div class="control">
                                    <a class="button is-info" v-on:click="getFound">
                                    Buscar
                                    </a>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="section">
                        <div class="field has-addons has-addons-right" v-if="found != '' ">
                            <p class="control">
                                <span class="select">
                                    <select>
                                        <option>$</option>
                                        <option>£</option>
                                        <option>€</option>
                                    </select>
                                </span>
                            </p>
                            <p class="control">
                                <input class="input" type="text" v-model="transaccion_info.monto" placeholder="Cantidad de dinero">
                            </p>
                            <p class="control" v-on:click="transferir">
                                <a class="button is-primary">
                                Transferir
                                </a>
                            </p>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                <button class="button" v-on:click="limpiaModal">Cancelar</button>
                </footer>
            </div>
        </div>
    </div>
</template>
<script>
import jsPDF from 'jspdf'
export default {
    props:['user'],
    data(){
        return{
            cliente :'',
            transaccion_info:{
                origen:'',
                destino:'',
                monto:0,
            },
            found:'',
            modal_trans:false,
            lista:[],
        }
    },
    methods:{
        getCliente(){
            this.$http.post('api/get_num_cliente',{
                usr:this.user
            }).then(response => {
                this.cliente = response.data;
                this.getLista();
            }).catch(error => console.log(error))
        },
        getLista(){
             this.$http.post('api/get_cli_cu',{
                cli:this.cliente
            }).then(response => {
                this.lista = response.data;
                this.getAcum();
            }).catch(error => console.log(error))
        },
        transaccion(folio){
            this.modal_trans = true;
            this.transaccion_info.origen = folio;
        },
        limpiaModal(){
            this.modal_trans = false;
            this.transaccion_info.origen = '';
            this.transaccion_info.destino = '';
            this.transaccion_info.monto = 0;
            this.found = ''
        },
        getFound(){
             this.$http.post('api/get_des',{
                des:this.transaccion_info.destino
            }).then(response => {
                this.found = response.data[0];
            }).catch(error => {
                alert('Cuenta no encontrada');
            })
        },
        transferir(){
            this.$http.post('api/post_transaccion',{
                org :this.transaccion_info.origen,
                des:this.transaccion_info.destino,
                monto:this.transaccion_info.monto
            }).then(response => {
                this.getLista();
                alert('Transaccion exitosa');
                this.limpiaModal();
            }).catch(error => {
                alert('El monto debe ser mayor a 0 y debe ser menor al saldo actual');
                console.log(error)
            });
        },
        getAcum(){
            this.$http.post('api/get_acum',{
                cli:this.cliente
            }).then(response => {
                this.acum = response.data;
            }).catch(error => {
                console.log(error)
            });
        },
        createPDF () {
            let pdfName = 'Balance_Cuentas'; 
            var doc = new jsPDF();
            doc.text('Saldo acumulado'+'\t' + this.acum, 10, 10)
            var columns = [
            {title:"Folio",dataKey:"folio"},
            {title:"Saldo",dataKey:"saldo"}];
            doc.autoTable(columns,this.lista);
            doc.save(pdfName + '.pdf');
        }

    },
    mounted(){
        this.getCliente();
    }
}
</script>
