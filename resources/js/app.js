import Vue from 'vue'
import router from './router.js'
import App from './App.vue'
import vuetify from './vuetify.js'
import store from './store.js' 
import './bootstrap.js'

Vue.component('campaign-item', require('./components/CampaignItem.vue').default);

const app = new Vue({
    el: "app",
    router,
    store,
    vuetify,
    components: {
        App
    },
});
