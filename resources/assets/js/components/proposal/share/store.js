import Vuex from 'vuex';
import * as Slc from "../../../vue/http";

export default new Vuex.Store({

    state: {
        id: null,
        proposal: null,
        face: null,
        markers: [],
    },

    getters: {},

    mutations: {
        setProposal(state, proposal) {
            state.proposal = proposal;
            state.markers.splice(0, state.markers.length);

            const faces = proposal.billboard_faces;

            for (let i = 0; i < faces.length; i++) {
                state.markers.push({
                    position: faces[i].position,
                    face: faces[i],
                });
            }
        },
        setFace(state, face) {
            state.face = face;
        },
        setId(state, id) {
            state.id = id;
        },
        commentSaved(state, comment) {
            if (!state.proposal.comments) {
                state.proposal.comments = [];
            }
            state.proposal.comments.push(comment);
        }
    },

    actions: {
        getProposal({commit}, proposalId) {
            const url = laroute.route('public.api.proposal.show', {proposal: proposalId});
            Slc.find(url).then((proposal) => {
                console.log('Load proposal: ', url, proposal);
                commit('setProposal', proposal);
            });
        },
        setFace({commit}, face) {
            commit('setFace', face);
        },
        setId({commit}, id) {
            commit('setId', id);
        },
        saveComment({commit}, form) {
            const uri = laroute.route('comment.store');
            return Slc.post(uri, form).then(response => {
                commit('commentSaved', response.data);
            });
        }
    }
});