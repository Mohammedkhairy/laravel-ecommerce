/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

let onlineUsers = 0;
window.Echo.join(`online`)
    .here((users) => {
        onlineUsers = users.length;
        if(onlineUsers > 1){
            $("#noUser").hide();
        }
        let userId = $('meta[name=user_id]').attr('content');
        users.forEach(user => {

            if(userId == user.id){
                return;
            }

            $("#online-user").append(`<li id="user-${user.id}" class="list-group-item"><span class="icon icon-circle text-success"></span> ${user.name}</li>`);
        });
    })
    .joining((user) => {
        onlineUsers++;
        $("#noUser").hide();
        $("#online-user").append(`<li id="user-${user.id}" class="list-group-item"> <span class="icon icon-circle text-success"></span> ${user.name}</li>`);
    })
    .leaving((user) => {
        onlineUsers--;
        if(onlineUsers == 1){
            $("#noUser").show();
        }
        $("#user-"+user.id).remove();
    });