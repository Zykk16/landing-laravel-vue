import request from '../../utils/Request'

const state = {
    categories: {},
}

const getters = {
    categories: state => state.categories,
}

const actions = {
    async getCategories({commit}) {
        const response = await request.get('/api/categories_cases')
        commit('setCategories', response.data.data)
    },

    async remove({commit}, id) {
        await request.delete(`/api/categories_cases/${id}`)
    },

    async save({commit}, {data}) {
        await request.put(`/api/categories_cases/${id}`, {data})
    }
}

const mutations = {
    setCategories: (state, categories) => state.categories = categories,
}

export default {
    namespaced: true,
    state, getters, actions, mutations
}
