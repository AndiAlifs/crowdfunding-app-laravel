import Vue from 'vue'
import Vuex from 'vuex'
import transaction from './transaction'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        transaction
    }
})
