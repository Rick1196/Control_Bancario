<template>
    <div v-if="sucursalesR">
            <div class="columns is-centered">
                <div class="column">
                        <div class="container">
                            <div class="section" v-if="sucursalesRender">
                                    <div class="content">
                                            <div class="section">
                                                <div class="field is-grouped">
                                                    <div class="select">
                                                        <p class="control">
                                                            <label class="label">Paises</label>
                                                            <select  v-model="pais_selected">
                                                                <option v-for="pais in paises" :key="pais.id_pais" :value="pais.id_pais">
                                                                    {{pais.nombre_pais}}
                                                                </option>
                                                            </select>
                                                        </p>
                                                    </div>
                                                    <p class="control">
                                                        <div class="select" v-if="renderC">
                                                            <label class="label">Ciudades</label>
                                                            <select  v-model="ciudad_selected">
                                                                <option v-for="ciudad in ciudades" :key="ciudad.id_ciudad" :value="ciudad.id_ciudad">
                                                                    {{ciudad.nombre_ciudad}}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="section" v-if="renderTS">
                                                <div class="section">
                                                    <div class="field is-horizontal">
                                                        <div class="field-label is-normal">
                                                            <label class="label">Nueva sucursal</label>
                                                        </div>
                                                        <div class="field-body">
                                                            <div class="field">
                                                                <p class="control">
                                                                    <input class="input" maxlength="20" minlength="10" v-model="sucursal.identificador" type="text" placeholder="Identificador de la sucursal">
                                                                </p>
                                                            </div>
                                                            <a class="button is-success is-rounded" v-on:click="postSuc()">Registrar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="section">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th><abbr title="Position">#</abbr></th>
                                                            <th><abbr title="Sucursal">Identificador sucursal</abbr></th>
                                                            <th><abbr title="Eliminar">Eliminar sucursal</abbr></th>
                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr>
                                                            <th><abbr title="Position">#</abbr></th>
                                                            <th><abbr title="Sucursal">Identificador sucursal</abbr></th>
                                                            <th><abbr title="Eliminar">Eliminar sucursal</abbr></th>
                                                        </tr>
                                                        </tfoot>
                                                        <tbody>
                                                        <tr v-for="(suc,num) in sucursales">
                                                            <th>{{num}}</th>
                                                            <th>
                                                                <div class="field has-addons has-addons-centered">
                                                                    <p class="control">
                                                                        <input class="input" type="text" v-model="suc.identificador_sucursal" >
                                                                    </p>
                                                                    <p class="control">
                                                                        <a class="button is-primary" v-on:click="upSuc(suc.id_sucursal, suc.identificador_sucursal)">
                                                                            Guardar
                                                                        </a>
                                                                    </p>
                                                                </div>
                                                            </th>
                                                            <td><a v-on:click="delSuc(suc.id_sucursal)" class="delete is-large"></a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div>
                            </div>
                        </div>
                </div>
            </div>
    </div>
</template>
<script>
export default {
    props:['user'],
    data(){
        return{
            ciudades:[],
            paises:[],
            pais_selected:'',
            ciudad_selected:'',
            sucursalesRender:false,
            clientesRender:false,
            cuentasRender:false,
            renderC:false,
            sucursales:[],
            renderTS:false,
            sucursal:{
                identificador:''
            },
            sucursalesR:true,
        }
    },
    methods:{
        getCiudades(){
            axios.get('api/get_ciudades/'+this.pais_selected).then(response => {
                this.ciudades = response.data;
                this.renderC = true;
            })
                .catch(error => console.log(error))
        },
        getPaises(){
            axios.get('api/get_paises').then(response => {
                this.paises = response.data;
                this.sucursalesRender = true;
            }).catch(error => console.log(error))
        },
        getSucursales(){
            axios.get('api/get_sucursales/'+this.ciudad_selected).then(response => {
                this.sucursales = response.data;
                this.renderTS = true;
            })
                .catch(error => console.log(error))
        },
        postSuc(){
            this.$http.post('api/post_sucursal',{
                ciudad: this.ciudad_selected,
                id:this.sucursal.identificador
            }).then(response => {
                this.getSucursales();
                this.renderTS = true;
                this.sucursal.identificador = '';
            }).catch(error => alert('Identificador repetido'))
        },
        delSuc(id){
            this.$http.post('api/delete_sucursal',{
                id:id
            }).then(response => {
                this.getSucursales();
            }).catch(error => console.log(error))
        },
        upSuc(id,text){
            this.$http.post('api/update_sucursal',{
                texto:text,
                id:id
            }).then(response => {
                this.getSucursales();
            }).catch(error => alert('Identificador ocupado'))
        },
        cleanAll(){
            this.ciudades = [];
            this.paises=[];
            this.sucursales=[];
            this.sucursalesRender = false;

        },
    },
    watch:{
        pais_selected: function () {
            this.getCiudades();
        },
        ciudad_selected: function () {
            this.getSucursales()
        }
    },
    mounted(){
        this.getPaises();
        this.$root.$on('render',(mensaje) => {
            if(mensaje === 'sucursales'){
                this.sucursalesR = true;
            }
            else{
                this.sucursalesR = false;
            }

        });
    }

}
</script>
