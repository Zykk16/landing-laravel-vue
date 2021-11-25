import request from '../../utils/Request'

const state = {
    cases: {},
    casesAll: {},
    statuses: {},
    casesUnsort: [],
    loading: false
}

const getters = {
    cases: state => state.cases,
    casesAll: state => state.casesAll,
    statuses: state => state.statuses,
    loading: state => state.loading
}

const actions = {
    async getCases({commit}) {
        const {data} = await request.get('/api/cases')
        commit('setCases', data.data)
        commit('setLoading')
    },

    async getCasesAll({commit}) {
        const {data} = await request.get('/api/cases-all')
        commit('setCasesAll', data)
        commit('setLoading')
    },

    async getStatuses({commit}) {
        const {data} = await request.get('/api/statuses')
        commit('setStatus', data)
    },

    createCases({commit}, data) {
        commit('prependOne', data)
    },

    updateCases({commit}, data) {
        commit('updateOne', data)
    },

    async remove({commit}, id) {
        await request.delete(`/api/cases/${id}`)
    }
}

const mutations = {
    setCases: (state, cases) => state.cases = cases,
    setCasesAll: (state, casesAll) => state.casesAll = casesAll,
    setStatus: (state, statuses) => state.statuses = statuses,
    prependOne: (state, cases) => state.casesUnsort.unshift(cases),
    updateOne: (state, updatedCases) => {
        const index = state.casesUnsort.findIndex(cases => cases.id === updatedCases.id);

        if (index > -1)
            state.casesUnsort.splice(index, 1, updatedCases);
    },
    setLoading: state => state.loading = true
}

export default {
    namespaced: true,
    state, getters, actions, mutations
}
