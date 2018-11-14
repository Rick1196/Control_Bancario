<template>
    <div>
            <nav class="level">
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading">Usuarios</p>
                    <p class="title">{{tUsuarios[0].res}}</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading">Clientes</p>
                    <p class="title">{{tClientes[0].res}}</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading">Trabajadores</p>
                    <p class="title">{{tTrabajadores[0].res}}</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                    <p class="heading">Cuentas manejadas</p>
                    <p class="title">{{tCuentas[0].res}}</p>
                    </div>
                </div>
            </nav>
            <div class="columns is-centered">
                <div class="tabs is-toggle is-toggle-rounded">
                    <ul>
                        <li v-on:click="clientesMeth">
                        <a>
                            <span class="icon is-small"><i class="fas fa-image"></i></span>
                            <span>Clientes</span>
                        </a>
                        </li>
                        <li v-on:click="cuentasMeth">
                        <a>
                            <span class="icon is-small"><i class="fas fa-music"></i></span>
                            <span>Cuentas</span>
                        </a>
                        </li>
                        <li v-on:click="sucursalesMeth">
                        <a>
                            <span class="icon is-small"><i class="fas fa-film"></i></span>
                            <span>Sucursales</span>
                        </a>
                        </li>
                        <li v-on:click="trabajadoresMeth">
                        <a>
                            <span class="icon is-small"><i class="fas fa-file-alt"></i></span>
                            <span>Trabajadores</span>
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="columns is-centered">
                <div class="column">
                        <div class="container is-fullhd">
                            <div class="section" v-if="sucursalesRender">
                                    <div class="content">
                                            <div class="columns">
                                                <div class="column">
                                                    <div>
                                                            <div class="control">
                                                                <div class="select is-primary">
                                                                    <label class="label">Paises</label>
                                                                    <select  v-model="pais_selected">
                                                                        <option v-for="pais in paises" :key="pais.id_pais" :value="pais.id_pais">
                                                                            {{pais.nombre_pais}}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="column">
                                                    <div v-if="renderC">
                                                        <div class="control">
                                                            <div  class="select is-primary">
                                                                <label class="label">Ciudades</label>
                                                                <select  v-model="ciudad_selected">
                                                                    <option v-for="ciudad in ciudades" :key="ciudad.id_ciudad" :value="ciudad.id_ciudad">
                                                                        {{ciudad.nombre_ciudad}}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                            <th><abbr title="Sucursal">Identificador sucursal</abbr></th>
                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr>
                                                            <th><abbr title="Position">#</abbr></th>
                                                            <th><abbr title="Sucursal">Identificador sucursal</abbr></th>
                                                        </tr>
                                                        </tfoot>
                                                        <tbody>
                                                        <tr v-for="(suc,num) in sucursales">
                                                            <th>{{num}}</th>
                                                            <td>{{suc.identificador_sucursal}}</td>
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
            tUsuarios:'',
            tClientes:'',
            tTrabajadores:'',
            tCuentas:'',
            ciudades:[],
            paises:[],
            pais_selected:'',
            ciudad_selected:'',
            sucursalesRender:false,
            clientesRender:false,
            cuentasRender:false,
            trabajadoresRender:false,
            renderC:false,
            sucursales:[],
            renderTS:false,
            sucursal:{
                identificador:''
            },
        }
    },
    methods:{
        getUsuariosT(){
            axios.get('api/get_num_usuarios').then(response => (this.tUsuarios = response.data))
            .catch(error => console.log(error))
        },
        getClientesT(){
            axios.get('api/get_num_clientes').then(response => (this.tClientes = response.data))
            .catch(error => console.log(error))
        },
        getTrabajadoresT(){
            axios.get('api/get_num_trabajadores').then(response => (this.tTrabajadores = response.data))
            .catch(error => console.log(error))
        },
        getCuentasT(){
            axios.get('api/get_num_cuentas').then(response => (this.tCuentas = response.data))
            .catch(error => console.log(error))
        },
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
            })
                .catch(error => console.log(error))
        },
        cuentasMeth(){
            alert('chido');
        },
        clientesMeth(){
            alert('chido');
        },
        trabajadoresMeth(){
            this.sucursalesRender = false;
        },
        sucursalesMeth(){
            this.getPaises();
        }
    },
    mounted(){
        this.getClientesT();
        this.getUsuariosT();
        this.getTrabajadoresT();
        this.getCuentasT();
    },
    watch:{
        pais_selected: function () {
            this.getCiudades();
        },
        ciudad_selected: function () {
            this.getSucursales()
        }
    }

}
</script>
