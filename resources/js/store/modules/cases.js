import request from '../../utils/Request'

const state = {
    cases: {},
    casesUnsort: [],
    loading: false
}

const getters = {
    cases: state => state.cases,
    loading: state => state.loading
}

const actions = {
    async getCases({commit}) {
        const {data} = await request.get('/api/cases')
        commit('setCases', data.data)
        commit('setLoading')
    },

    createCases({commit}, data) {
        console.log(1)
        commit('prependOne', data)
    },

    updateCases({commit}, data) {
        console.log(2)
        commit('updateOne', data)
    },

    async remove({commit}, id) {
        await request.delete(`/api/cases/${id}`)
    }
}

const mutations = {
    setCases: (state, cases) => state.cases = cases,
    prependOne: (state, cases) => state.casesUnsort.unshift(cases),
    updateOne: (state, updatedCases) => {
        const index = state.casesUnsort.findIndex(cases => cases.id === updatedCases.id);

        if (index > -1)
            state.casesUnsort.splice(index, 1, updatedCases);
    },
    removeOne: (state, id) => state.casesUnsort = state.casesUnsort.filter(cases => cases.id !== id),
    setLoading: state => state.loading = true
}

export default {
    namespaced: true,
    state, getters, actions, mutations
}
