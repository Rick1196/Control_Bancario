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
                    <li v-on:click="otros('clientes')">
                        <a>
                            <span class="icon is-small"><i class="fas fa-image"></i></span>
                            <span>Clientes</span>
                        </a>
                    </li>
                    <li v-on:click="otros('cuentas')">
                        <a>
                            <span class="icon is-small"><i class="fas fa-music"></i></span>
                            <span>Cuentas</span>
                        </a>
                    </li>
                    <li v-on:click="otros('sucursales')">
                        <a>
                            <span class="icon is-small"><i class="fas fa-film"></i></span>
                            <span>Sucursales</span>
                        </a>
                    </li>
                    <li v-on:click="otros('trabajadores')">
                        <a>
                            <span class="icon is-small"><i class="fas fa-file-alt"></i></span>
                            <span>Trabajadores</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
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
            otros(mensaje){
                this.$root.$emit('render',mensaje);
            },
        },
        mounted(){
            this.getClientesT();
            this.getUsuariosT();
            this.getTrabajadoresT();
            this.getCuentasT();
            this.$root.$on('actualiza',() => {
                this.getClientesT();
                this.getUsuariosT();
                this.getTrabajadoresT();
                this.getCuentasT();
            });
        },
        data(){
            return{
                tUsuarios:'',
                tClientes:'',
                tTrabajadores:'',
                tCuentas:'',
            }
        }

    }
</script>