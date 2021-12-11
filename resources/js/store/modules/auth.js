import request from "../../utils/Request"


const state = {
    authenticated: false,
    user: null
}

const getters = {
    authenticated: state => state.authenticated,
    user: state => state.user
}

const actions = {
    async login ({ dispatch }, credentials) {
        await request.get('/sanctum/csrf-cookie')
        await request.post('/login', credentials)

        return dispatch('me')
    },

    async logout ({ dispatch }) {
        await request.post('/logout')

        return dispatch('me')
    },

    me ({ commit }) {
        return request.get('/api/user').then((response) => {
            commit('setAuthenticated', true)
            commit('setUser', response.data)
        }).catch(() => {
            commit('setAuthenticated', false)
            commit('setUser', null)
        })
    }
}

const mutations = {
    setAuthenticated: (state, value) => state.authenticated = value,
    setUser: (state, data) => state.user = data
};

export default {namespaced: true, state, getters, actions, mutations};

