import request from '../../utils/Request'

const state = {
    clients: {},
}

const getters = {
    clients: state => state.clients,
}

const actions = {
    async getClients({commit}) {
        const response = await request.get('/api/clients')
        commit('set', response.data)
    },

    async remove({commit}, id) {
        await request.delete(`/api/clients/${id}`)
    },

    async saveOrder({commit}, {id, orderId}) {
        await request.put(`/api/clients/${id}`, {order: orderId})
    }
}

const mutations = {
    set: (state, clients) => state.clients = clients,
}

export default {
    namespaced: true,
    state, getters, actions, mutations
}
