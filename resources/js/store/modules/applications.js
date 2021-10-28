import request from '../../utils/Request'

const state = {
    applications: [],
    filtersApp: {
        created_at: '',
        name: '',
    },
    sort: {
        type: 'created_at',
        desc: true
    },
    applicationsUnsort: []
};

const getters = {
    applications: state => state.applications,
}

const actions = {
    async getApplications({commit}) {
        const params = {
            sort: state.sort.type,
            desc: state.sort.desc ? 1 : 0,
            created_at: state.filtersApp.created_at,
            name: state.filtersApp.name,
        }

        const response = await request.get('/api/applications', {params})
        commit('setApplications', response.data)
    },
    async updateFilters({commit}, {filtersCreatedAt, filtersName}) {
        commit('setFilters', {filtersCreatedAt, filtersName})
    },
    async updateSort({commit}, type) {
        commit('setSort', type);
    },
}

const mutations = {
    setApplications: (state, applications) => state.applications = applications,
    setSort: (state, type) => {
        if (state.sort.type === type) {
            state.sort.desc = !state.sort.desc;
        } else {
            state.sort.type = type;
            state.sort.desc = false;
        }
    },
    setFilters: (state, {filtersCreatedAt, filtersName}) => {
        state.filtersApp.created_at = filtersCreatedAt
        state.filtersApp.name = filtersName
    },
}

export default {
    namespaced: true,
    state, getters, actions, mutations
}
