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



//axios.defaults.baseURL = 'http://127.0.0.1:8000';
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';


const app = new Vue({
        el: '#app',
        data: {
            tweet: "",
            tweets: [],
        },
        methods: {
            postTweet() {
                axios.post('/api/tweet', {
                    tweet: app.tweet,
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },

            getTweets() {
                axios.get('/api/tweets')
                    .then(function (response) {
                        /*console.log(response)*/

                        app.tweets = response.data

                        console.log(app.tweets)


                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        mounted() {

            //this.getTweets();

           /* console.log(this.tweets)*/
        }


    },
);


