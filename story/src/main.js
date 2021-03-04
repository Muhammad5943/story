import Vue from 'vue';
import App from './App.vue';
import router from './router'
import store from './store'
import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm';
import 'popper.js'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'axios';
import axios from 'axios';

axios.defaults.withCredentials = true;
/* to get shortcut off baseURL for post and get on the api */
axios.defaults.baseURL = "http://localhost:8000/"

/* this is promise "store.dispatch" */
store.dispatch('auth/me').finally(() => {
  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')
})

/* import Vue from 'vue'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.min.css'
' */
// import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm';

// Import the styles directly. (Or you could add them via script tags.)

Vue.use(BootstrapVue);


Vue.config.productionTip = false

