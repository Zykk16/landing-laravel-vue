import axios from 'axios'
import router from '../../router'

const state = {
    authenticated: false,
    user: null
};

const getters = {
    authenticated: state => state.authenticated,
    user: state => state.user
};

const actions = {
    login({commit}) {
        return axios.get('/api/user').then(({data}) => {
            commit('setUser', data)
            commit('setAuthenticated', true)
            router.push({name: 'admin'})
        }).catch(() => {
            commit('setUser', {})
            commit('setAuthenticated', false)
        })
    },

    logout({commit}) {
        commit('setUser', {})
        commit('setAuthenticated', false)
    }
}

const mutations = {
    setAuthenticated: (state, value) => state.authenticated = value,
    setUser: (state, data) => state.user = data
};

export default {namespaced: true, state, getters, actions, mutations};

