import request from "../../utils/Request"

const state = {
    applications: [],
    categories: []
}

const getters = {
    applications: state => state.applications,
    categories: state => state.categories
}

const actions = {
    async getApplications({commit}) {
        const {data} = await request.get('/api/applications')

        commit('setApplications', data)
    },

    async getCategories({commit}) {
        const {data} = await request.get('/api/application-categories')

        commit('setCategories', data)
    },
}

const mutations = {
    setApplications: (state, data) => state.applications = data,
    setCategories: (state, data) => state.categories = data,
}

export default {namespaced: true, state, getters, actions, mutations}
