<template>
    <div class="container">
        <div class="section" v-if="render1 == true">
            <div class="field">
                <label class="label">Usuario</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Usuario" v-model="new_user.usuario">
                </div>
            </div>

            <div class="field">
                <label class="label">Password</label>
                <div class="control">
                    <input class="input is-success" type="password" v-model="new_user.password">
                <p class="help is-success">Minimo 6 caracteres</p>
                </div>
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input is-danger" type="email" placeholder="Email@" v-model="new_user.email">
                </div>
            </div>

            <div class="field">
                <label class="label">RFC</label>
                <div class="control">
                    <input class="input is-success" maxlength="13" type="text" v-model="new_user.rfc">
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-link" v-on:click="postUser()">Guardar</button>
                </div>
                <div class="control">
                    <button class="button is-text" v-on:click="clear_new()">Cancelar</button>
                </div>
            </div>
            <div class="container">
                <div class="section">
                    <center>
                        <table class="table">
                            <thead>
                                <th><abbr title="#">#</abbr></th>
                                <th><abbr title="Usuario">Usuario</abbr></th>
                                <th><abbr title="RFC">RFC</abbr></th>
                                <th><abbr title="Acciones">Acciones</abbr></th>
                            </thead>
                            <tbody>
                                <tr v-for="(cliente,num) in lista">
                                    <th>{{num+1}}</th>
                                    <td><input type="text" class="is-rounded" v-model="cliente.nombre"></td>
                                    <td><input type="text" class="is-rounded" v-model="cliente.rfc"></td>
                                    <td><button class="button is-link is-rounded" v-on:click="actualiza(cliente.nombre,cliente.rfc,cliente.cliente,cliente.usuario)">Actualizar</button></td>
                                    <td><button class="button is-danger is-rounded" v-on:click="eliminar(cliente.usuario)">Eliminar</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted(){
            this.$root.$on('render',(mensaje) => {
                if(mensaje === 'clientes'){
                    this.render1 = true;
                }
                else{
                    this.render1 = false;
                }

            });
            this.getLista();
        },
        data(){
            return{
                render1: false,
                roles : [],
                new_user:{
                    rol_selected :'',
                    usuario:'',
                    password:'',
                    email:'',
                    rfc:'',
                },
                lista :[],
            }
        },
        methods:{
            postUser(){
                this.$http.post('api/post_cliente',{
                    name: this.new_user.usuario,
                    pass:this.new_user.password,
                    rfc:this.new_user.rfc,
                    mail:this.new_user.email
                }).then(response => {
                    this.clear_new();
                    this.getLista();
                    this.$root.$emit('actualiza');
                }).catch(error => alert('El usuario o email ya estan en uso'))
            },
            clear_new(){
                this.new_user.rol_selected = '';
                this.new_user.usuario = '';
                this.new_user.password = '';
                this.new_user.email = '';
                this.new_user.rfc = '';
            },
            getLista(){
                this.$http.get('api/get_lista_clientes').then(response => {
                    this.lista = response.data;
                }).catch(error => console.log(error))
            },
            actualiza(nombre,rfc,cliente,usuario){
                this.$http.post('api/put_cliente',{
                    name:nombre,
                    rfc:rfc,
                    usr:usuario,
                    cl:cliente
                }).then(response => {
                    this.lista = response.data;
                    this.getLista();
                }).catch(error => console.log(error))
            },
            eliminar(id){
                this.$http.post('api/delete_cliente',{
                    cl:id,
                }).then(response => {
                    this.lista = response.data;
                    this.getLista();
                }).catch(error => console.log(error))
            }
        }
    }
</script>