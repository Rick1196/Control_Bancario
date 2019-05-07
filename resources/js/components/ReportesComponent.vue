<template>
    <div v-if="render1">
        <div class="container">
            <div class="section">
                <div class="field is-grouped">
                    <p class="control">
                        <p class="control">
                            <input class="input"  v-model="inicio" type="date">
                        </p>
                        <p class="control">
                            <a class="button is-static">
                            Inicio
                            </a>
                        </p>
                    </p>
                    <p class="control">
                         <p class="control">
                            <input class="input"  v-model="fin" type="date">
                        </p>
                        <p class="control">
                            <a class="button is-static">
                            Fin
                            </a>
                        </p>
                    </p>
                </div>
                <div class="section">
                    <div class="field is-grouped">
                        <p class="control">
                            <p class="control">
                                <input class="input" v-model="r1" type="number">
                            </p>
                            <p class="control">
                                <a class="button is-static">
                                Monto menor
                                </a>
                            </p>
                            <p class="control">
                            <p class="control">
                                <input class="input"  v-model="r2" type="number">
                            </p>
                            <p class="control">
                                <a class="button is-static">
                                Monto mayor
                                </a>
                            </p>
                        </p>
                    </div>
                    <div class="section">
                        <p class="control">
                            <a class="button is-primary" v-on:click="montos">
                            Generar por monto
                            </a>
                        </p>
                        <br>
                        <p class="control">
                            <a class="button is-primary" v-on:click="fechas">
                            Generar por fecha
                            </a>
                        </p>
                        <br>
                        <p class="control">
                            <a class="button is-primary" v-on:click="ambos">
                            Generar por monto y fecha
                            </a>
                        </p>
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
            render1:false,
            fin:'',
            inicio:'',
            r1:0,
            r2:0        
        }
    },
    methods:{
        montos(){
            this.$http.post('api/montos',{
                r1:this.r1,
                r2:this.r2,
            }).then(response => {
                var temp = response.data.slice(0,100);
                let pdfName = 'Reporte_montos'; 
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
        fechas(){
            this.$http.post('api/fechas',{
                r1:this.inicio,
                r2:this.fin,
            }).then(response => {
                var temp = response.data.slice(0,100);
                let pdfName = 'Reporte_fechas'; 
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
        ambos(){
            this.$http.post('api/ambos',{
                r1:this.inicio,
                r2:this.fin,
                f1:this.inicio
            }).then(response => {
                var temp = response.data.slice(0,100);
                let pdfName = 'Reporte_total'; 
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
        generar(){
            if(this.r1 != 0 && this.inicio == '' ){
                this.montos();
            }
            else if(this.r1 == 0 && this.inicio != "" ){
                this.fechas();
            }
            else if(this.r1 != 0 && this.inicio != '' ){
                this.ambos();
            }
        }
    },
    mounted(){
        this.$root.$on('render',(mensaje) => {
                if(mensaje === 'reportes'){
                    this.render1 = true;
                }
                else{
                    this.render1 = false;
                }

        });
    }
}
</script>

