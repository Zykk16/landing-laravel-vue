import request from "../../utils/Request"

const state = {
    applications: [],
    categories: [],
    selectedCategories: [],
    filtersApp: {
        created_at: '',
        name: '',
        phone: '',
        email: ''
    },
    sort: {
        type: 'created_at',
        desc: true
    }
}

const getters = {
    applications: state => state.applications,
    categories: state => state.categories
}

const actions = {
    async getApplications({commit, state}) {
        const params = {
            categories: state.selectedCategories,
            sort: state.sort.type,
            desc: state.sort.desc ? 1 : 0,
            created_at: state.filtersApp.created_at,
            name: state.filtersApp.name,
            phone: state.filtersApp.phone,
            email: state.filtersApp.email,
        }

        const {data} = await request.get('/api/applications', {params})

        commit('setApplications', data)
    },

    async getCategories({commit}) {
        const {data} = await request.get('/api/application-categories')

        commit('setCategories', data)
    },


    async updateSelectedCategories({commit}, categories) {
        const selectedCategories = []

        Object.keys(categories).forEach(key => {
            if (categories[key]) {
                selectedCategories.push(parseInt(key))
            }
        })

        commit('setSelectedCategories', selectedCategories)
    },

    async updateSort({commit}, type) {
        commit('setSort', type)
    },

    async updateFilters({commit}, {
        filtersCreatedAt,
        filtersName,
        filtersPhone,
        filtersEmail
    }) {
        commit('setFilters', {filtersCreatedAt, filtersName, filtersPhone, filtersEmail})
    }
}

const mutations = {
    setApplications: (state, data) => state.applications = data,
    setCategories: (state, data) => state.categories = data,
    setSelectedCategories: (state, data) => state.selectedCategories = data,
    setSort: (state, type) => {
        if (state.sort.type === type) {
            state.sort.desc = !state.sort.desc
        } else {
            state.sort.type = type
            state.sort.desc = false
        }
    },
    setFilters: (state, {
        filtersCreatedAt, filtersName, filtersPhone, filtersEmail
    }) => {
        state.filtersApp.created_at = filtersCreatedAt
        state.filtersApp.name = filtersName
        state.filtersApp.phone = filtersPhone
        state.filtersApp.email = filtersEmail
    }
}

export default {namespaced: true, state, getters, actions, mutations}
