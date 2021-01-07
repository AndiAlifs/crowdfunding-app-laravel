export default {
    namespaced: true,
    state: {
        transaction: 0,
    }, 
    mutations: {
        insert : (state, payload) => {
            state.transaction++
        }
    },
    actions: {

    },
    getters: {
        transaction: state => state.transaction
    }
}
