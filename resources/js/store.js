import Vue from 'vue'
import Vuex from 'vuex'
import transaction from './transaction'
import alert from './alert'
import auth from './auth'
import dialog from './dialog'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        transaction,
        alert,
        auth,
        dialog
    }
})
