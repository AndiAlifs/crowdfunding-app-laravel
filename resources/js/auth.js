export default {
    namespaced: true,
    state: {
        user: {},
        token: {}
    },
    mutations: {
        set: (state, payload) => {
            state.token = payload.token
            state.user = payload.user
        },
    },
    actions: {
        set: ({commit}, payload) => {
            commit('set', payload)
        }
    },
    getters: {
        user: state => state.user,
        token: state => state.token,
        guest: state => Object.keys(state.user).length === 0
    }
}