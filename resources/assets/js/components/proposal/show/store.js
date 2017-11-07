import Vuex from 'vuex';
import * as Slc from "../../../vue/http";

export default new Vuex.Store({

    state: {
        user: null,
        proposal: null,
        billboards: [],
        billboard: null,
        markers: [],
    },

    getters: {},

    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setProposal(state, proposal) {
            state.proposal = proposal;
        },
        setBillboards(state, billboards) {
            state.billboards.splice(0, state.billboards.length);
            state.markers.splice(0, state.markers.length);

            for (let i = 0; i < billboards.length; i++) {
                state.markers.push({
                    position: {
                        lat: parseFloat(billboards[i].lat),
                        lng: parseFloat(billboards[i].lng)
                    },
                    billboard: billboards[i],
                });
            }
        },
        setBillboard(state, billboard) {
            state.billboard = billboard;
        },
    },

    actions: {
        getProposal({commit}, proposalId) {
            const url = laroute.route('api.proposal.show', {proposal: proposalId});
            Slc.find(url).then((response) => {
                console.log('Load proposal: ', url, response);
                commit('setProposal', response);
            });
        },
        getBillboards({commit}, proposalId) {
            const uri = laroute.route('api.billboard.index', {proposalId: proposalId});
            Slc.get(uri)
                .then((response) => {
                    commit('setBillboards', response);
                });
        },
        getUser({commit}) {
            commit('setUser', window.Slc.user);
        },
        setBillboard({commit}, billboard) {
            commit('setBillboard', billboard);
        },
    }
});