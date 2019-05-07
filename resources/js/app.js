
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue'); 
Vue.use(require('vue-resource')); 

window.Vue = require('vue');
var jsPDF = require('jspdf');
require('jspdf-autotable');


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('clientes', require('./components/ClientesComponent.vue'));
Vue.component('atms', require('./components/AtmComponent.vue'));
Vue.component('cajeros', require('./components/CajerosComponent.vue'));
Vue.component('admins', require('./components/AdminComponent.vue'));
Vue.component('auditores', require('./components/AuditorComponent.vue'));
Vue.component('workers', require('./components/WorkerComponent.vue'));
Vue.component('nav-adm', require('./components/AdmNavComponent.vue'));
Vue.component('clients', require('./components/ClienteComponent.vue'));
Vue.component('cuentas', require('./components/CuentasComponent.vue'));
Vue.component('reportes-view', require('./components/ReportesComponent.vue'));


const app = new Vue({
    el: '#app'
});


// Bulma NavBar Burger Script
document.addEventListener('DOMContentLoaded', function () {
    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
    
    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {
        
        // Add a click event on each of them
        $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {
                
                // Get the target from the "data-target" attribute
                let target = $el.dataset.target;
                let $target = document.getElementById(target);
                
                // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                $el.classList.toggle('is-active');
                $target.classList.toggle('is-active');
                
            });
        });
    }
    
});



require('./bulma-extensions');
