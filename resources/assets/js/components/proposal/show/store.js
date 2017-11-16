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

    getters: {



    },

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
        addBillboardFace(state, billboardFace) {
            state.proposal.billboard_faces.push(billboardFace);
        },
        removeBillboardFace(state, billboardFace) {
            const faces = state.proposal.billboard_faces;
            faces.splice(faces.indexOf(billboardFace), 1);
        },

        moveToList(state, billboardFaces) {
           setTimeout( function () {
               debugger;
                for (var face = 0; face < billboardFaces.billboard_faces.length; face ++){
                    state.proposal.billboard_faces[face].pivot.forEach(attributes => {
                        state.proposal.billboard_faces[face].pivot[attributes] = billboardFaces[face].pivot[attributes];

                    });
                }

          },3000);
        },

        save(state) {

            let form;
            let faces = state.proposal.billboard_faces;

            faces.forEach(face => {

                form = new SlcForm({
                    billboard_face: face.id,
                    price: 999.99,
                    order: face.pivot.order
                });

                console.log('Faces each name',face.code, 'order',face.pivot.order);

            });
        },

    },

    actions: {
        getProposal({commit}, proposalId) {
            const url = laroute.route('api.proposal.show', {proposal: proposalId});
            Slc.find(url).then((proposal) => {
                console.log('Load proposal: ', url, proposal);
                commit('setProposal', proposal);

                const uri = laroute.route('api.billboard.index', {proposalId: proposalId});
                Slc.get(uri)
                    .then((billboards) => {
                        commit('setBillboards', billboards);
                    });
            });
        },
        getUser({commit}) {
            commit('setUser', window.Slc.user);
        },
        setBillboard({commit}, billboard) {
            commit('setBillboard', billboard);
        },
        removeBillboardFace({commit}, billboardFace) {
            commit('removeBillboardFace', billboardFace);
        },
    }
});