<template>
    <div>
        <div class="container">
            <div id="flow">
                <span class="flow-1"></span>
                <span class="flow-2"></span>
                <span class="flow-3"></span>
            </div>
            <div class="section">
                <div class="box">
                    <div class="field has-addons">
                        <div class="control is-expanded">
                            <input class="input has-text-centered" type="search" v-model="folio" placeholder="» » » » » » Folio de cuenta « « « « « «">
                        </div>
                        <div class="control">
                            <a class="button is-info" v-on:click="encuentra">Buscar</a>
                        </div>
                    </div>
                </div>
                <div class="columns" v-if="this.encontrado.length != 0">
                    <div class="column is-half">
                    <div class="card large">
                        <div class="card-content">
                            <div class="field has-addons has-addons-centered">
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
                                    <input class="input" v-model="monto" type="text" placeholder="Cantidad de deposito">
                                </p>
                                <p class="control">
                                    <a class="button is-primary" v-on:click="depositar">
                                    Depositar
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="card large">
                        <div class="card-content">
                            <a class="button is-large is-fullwidth" v-on:click="getTransacciones">Obtener valance</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import jsPDF from 'jspdf'
export default {
     data(){
         return{
             folio:'',
             transacciones :'',
             monto :0,
             encontrado:[],
             acumulado:0,
         }
     },
     methods:{
         getTransacciones(){
             this.$http.post('api/get_transacciones',{
                folio:this.folio
            }).then(response => {
                var temp = response.data;
                this.getMonto();
                let pdfName = 'Balance_Cuenta'; 
                var doc = new jsPDF();
                doc.text('Total'+'\t' + this.acumulado, 10, 10)
                var columns = [
                {title:"Folio",dataKey:"fol"},
                {title:"Monto",dataKey:"mon"},
                {title:"Fecha",dataKey:"fecha"}
                ];
                doc.autoTable(columns,temp);
                doc.save(pdfName + '.pdf');
            }).catch(error => console.log(error))
         },
         getMonto(){
             this.$http.post('api/get_montoT',{
                folio:this.folio
            }).then(response => {
                this.acumulado = response.data;
            }).catch(error => console.log(error))
         },
         depositar(){
             this.$http.post('api/depositar',{
                folio:this.folio,
                monto:this.monto
            }).then(response => {
                this.transacciones = response.data;
                this.monto = 0;
                alert("Deposito exitoso")
            }).catch(error => {
                alert("El monto debe ser mayor a 0")
                console.log(error)})
         },
         encuentra(){
            this.$http.post('api/encuentra',{
                folio:this.folio,
            }).then(response => {
                this.encontrado = response.data;
                if(this.encontrado.length === 0){
                    alert('Cuenta no existente')
                }
            }).catch(error => console.log(error))
         },
     },
     mounted(){

     }
}
</script>
