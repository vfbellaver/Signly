import Vuex from 'vuex';
import * as Slc from "../../../vue/http";

export default new Vuex.Store({

    state: {
        user      : null,
        proposal  : null,
        billboard : null,
        billboards: [],
        filters   : {
            type        : null,
            illumination: null,
        },
    },

    getters: {
        markers: (state) => {
            const markers = [];
            const billboards = state.billboards.filter(b => b.id);

            const filterMethod = (face) => {
                if (state.filters.type && face.type !== state.filters.type) return false;

                if (state.filters.type && face.type === 'Static' && state.filters.illumination) {
                    if (face.is_illuminated && state.filters.illumination !== '1') return false;
                    if (!face.is_illuminated && state.filters.illumination !== '2') return false;
                }
                return true;
            };

            for (let i = 0; i < billboards.length; i++) {
                const billboard = state.billboards[i];
                let faces = billboard.billboard_faces.filter(face => {
                    return filterMethod(face);
                });

                if (!faces.length) continue;

                markers.push({
                    position : {
                        lat: parseFloat(billboard.lat),
                        lng: parseFloat(billboard.lng)
                    },
                    billboard: billboard,
                });
            }
            console.log("Getting markers", markers.length, markers);
            return markers;
        }
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
            state.billboards = billboards;
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
        faceCreated(state, face) {
            console.log('Face Created', face);
            face.pivot.price = face.pivot.price.replace(',', '');
            const faces = state.proposal.billboard_faces;
            faces.push(face);
        },
        faceUpdated(state, face) {
            console.log('Face Updated', face);
            const faces = state.proposal.billboard_faces;
            for (let i = 0; i < faces.length; i++) {
                const f = faces[i];
                if (f.id === face.id) {
                    Object.assign(f, face);
                }
            }
        },
        commentSaved(state, comment) {
            if (!state.proposal.comments) {
                state.proposal.comments = [];
            }
            state.proposal.comments.push(comment);
        },
        addComment(state, comment) {
            state.proposal.comments.push(comment);
        },
        viewMessages(state) {
            const comments = state.proposal.comments;
            for (let i = 0; i < comments.length; i++) {
                const comment = comments[i];
                comment.visualized = true;
            }
        },
        setFilters(state, filters) {
            state.filters = filters;
        }
    },

    actions: {
        getProposal({commit}, proposalId) {
            const url = laroute.route('api.proposal.show', {proposal: proposalId, timezone: moment.tz.guess()});
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
        addBillboardFace({commit}, proposal, form) {
            form.timezone = moment.tz.guess();
            const uri = laroute.route('api.proposal.add-billboard-face', {proposal: proposal.id});
            Slc.post(uri, form).then(response => {
                commit('addBillboardFace', response);
            });
        },
        removeBillboardFace({commit}, face) {
            const form = new SlcForm({});
            form.timezone = moment.tz.guess();
            const pivot = face.pivot;
            const uri = laroute.route('api.proposal.destroy-billboard-face',
                {proposal: pivot.proposal_id, face: face.id})

            Slc.delete(uri, form).then(response => {
                commit('removeBillboardFace', face);
            });
        },
        faceCreated({commit}, face) {
            commit('faceCreated', face);
        },
        faceUpdated({commit}, face) {
            commit('faceUpdated', face);
        },
        reorderBillboardFaces({commit}, form) {
            const uri = laroute.route('api.proposal.reorder-billboard-faces', {proposal: form.proposal_id});
            Slc.put(uri, form).then(response => {
            });
        },
        saveComment({commit}, form) {
            form.timezone = moment.tz.guess();
            const uri = laroute.route('comment.store');
            return Slc.post(uri, form).then(response => {
                console.log('response - ', response);
                commit('commentSaved', response);
            });
        },
        addComment({commit}, comment) {
            commit('addComment', comment);
        },
        viewMessages({commit}) {
            commit('viewMessages');
        },
        setFilters({commit}, filters) {
            commit('setFilters', filters);
        }
    }
});