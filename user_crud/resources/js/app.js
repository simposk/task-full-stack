
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

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    methods: {
        sendPostRequest: function(data) {
            let token = document.querySelector('meta[name="csrf-token"]').content;
            let apiEndpoint = 'http://localhost:8000/ajax-users/';
            let xhttp = new XMLHttpRequest();

            let formated = data.map(function(item) {
                return {
                    'name': item.name,
                    'email': item.email,
                    'role': 'user'
                }
            });

            xhttp.open("POST", apiEndpoint, true);

            xhttp.setRequestHeader('X-CSRF-TOKEN', token);
            xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=UTF-8');

            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    console.log('Success');
                }
            };
            console.log(formated);
            xhttp.send(formated);
        },

        callApi: function() {
            let apiEndpoint = 'https://jsonplaceholder.typicode.com/users';
            let xhttp = new XMLHttpRequest();

            xhttp.onload = function () {

                if (xhttp.status >= 200 && xhttp.status < 300) {
                    let data = JSON.parse(xhttp.response);
                    app.sendPostRequest(data);
                } else {
                    console.log('The request failed!');
                }
            };

            xhttp.open("GET", apiEndpoint, true);
            xhttp.send();
        },
    }
});
