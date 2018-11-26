<template>
    <div class="container">
        <div class="section" v-if="render1">
            <div class="section">
                <div class="field has-addons">
                    <div class="control">
                        <input class="input" v-model="rfc" maxlength="13" type="text" placeholder="RFC">
                    </div>
                    <div class="control">
                        <a class="button is-info" v-on:click="getCliente">
                        Buscar
                        </a>
                    </div>
                </div>
                <div class="field is-horizontal" v-if="found.length != ''">
                    <div class="field-label is-normal">
                        <label class="label">Cliente</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input" v-model="found.rfc" disabled type="text" placeholder="RFC">
                                <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" v-if="found.length != ''">
                <div class="field has-addons has-addons-right">
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
                        <input class="input" type="text" v-model="new_c.saldo" placeholder="Monto inicial">
                    </p>
                    <p class="control">
                        <a class="button is-primary" v-on:click="postCuenta()">
                        Abrir nueva cuenta
                        </a>
                    </p>
                    </div>
            </div>
            <div class="section" v-if="lista.length > 0">
                <center>
                    <table class="table">
                        <thead>
                            <th><abbr title="#">#</abbr></th>
                            <th><abbr title="Folio">Folio</abbr></th>
                            <th><abbr title="Saldo">Saldo</abbr></th>
                            <th><abbr title="Acciones">Acciones</abbr></th>
                        </thead>
                        <tbody>
                            <tr v-for="(cu,num) in lista">
                                <th>{{num+1}}</th>
                                <td>{{cu.folio}}</td>
                                <td><input type="text" v-model="cu.saldo"></td>
                                <td><button class="button is-link is-rounded" v-on:click="update(cu.folio,cu.saldo)">Actualizar</button></td>
                                <td><button class="button is-danger is-rounded" v-on:click="borrar(cu.folio)">Eliminar</button></td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            rfc:'',
            found:'',
            new_c:{
                saldo:2000,
            },
            lista:[],
            render1: false,
        }
    },
    mounted(){
        this.$root.$on('render',(mensaje) => {
                if(mensaje === 'cuentas'){
                    this.render1 = true;
                }
                else{
                    this.render1 = false;
                }

            });
    },
    methods:{
        getCliente(){
            this.$http.get('api/get_cliente/'+this.rfc).then(response => {
                var temp = response.data;
                if(temp.length > 0){
                    this.found = response.data[0];
                    this.getLista();
                }
                else{
                    alert('RFC no encontrado');
                    this.found = '';
                }
                }).catch(error => console.log(error))
        },
        getLista(){
            this.$http.get('api/get_cuentas_cliete/'+this.found.id_cliente).then(response => {
                this.lista = response.data;
                }).catch(error => console.log(error))
        },
        update(folio,saldo){
            this.$http.post('api/put_cuenta',{
                folio:folio,
                saldo:saldo
            }).then(response => {
                this.getLista();
                alert('Modificacion exitosa')
            }).catch(error => console.log(error))
        },
        borrar(folio){
            this.$http.post('api/delete_cuenta',{
                id:folio
            }).then(response => {
                this.getLista();
                alert('Eliminacion exitosa');
                }).catch(error => console.log(error))
        },
        postCuenta(){
            this.$http.post('api/post_cuenta',{
                saldo:this.new_c.saldo,
                cliente:this.found.id_cliente
            }).then(response => {
                this.getLista();
                console.log(response.data);
                alert('Apertura exitosa');
                }).catch(error =>{
                    var str = error.body.message;
                    if(str.includes('ORA-24374')){
                        this.getLista();
                        alert('Apertura exitosa')
                    }
                    else{
                        alert('El saldo minimo de apertura es de 1000')
                    }
                })
        }
    },

}
</script>

