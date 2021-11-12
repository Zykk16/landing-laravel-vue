import request from '../../utils/Request'

const state = {
    categories: {},
    categoriesUnsort: [],
    loading: false
}

const getters = {
    categories: state => state.categories,
    loading: state => state.loading
}

const actions = {
    async getCategories({commit}) {
        const response = await request.get('/api/categories_cases')
        commit('setCategories', response.data.data)
        commit('setLoading')
    },

    async updateCategory({commit}, {id, data}) {
        const response = await request.put(`/api/categories_cases/${id}`, data)
        commit('updateOne', response.data)
    },

    createCategory({commit}, category) {
        commit('prependOne', category)
    },

    async remove({commit}, id) {
        await request.delete(`/api/categories_cases/${id}`)
    }
}

const mutations = {
    setCategories: (state, categories) => state.categories = categories,
    updateCategory: (state, data) => {
        const index = state.categories.findIndex(category => category.id === data.id)

        if (index > -1)
            state.categories.splice(index, 1, data)
    },
    updateOne: (state, updatedCategory) => {
        const index = state.categoriesUnsort.findIndex(category => category.id === updatedCategory.id)

        if (index > -1)
            state.categoriesUnsort.splice(index, 1, updatedCategory)
    },
    prependOne: (state, category) => state.categoriesUnsort.unshift(category),
    setLoading: state => state.loading = true

}

export default {
    namespaced: true,
    state, getters, actions, mutations
}
