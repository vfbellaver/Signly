<template>
    <div class="proposal-list">
        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>
        <nav class="navbar navbar-in-content navbar-default" data-spy="affix" data-offset-top="147">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a @click="showFilters = !showFilters">
                        <i class="fa fa-filter"></i>
                        Filters</a>
                </li>
                <li>
                    <a @click="fitToMarkers">
                        <i class="fa fa-arrows-alt"></i>
                        Fit to Markers</a>
                </li>
                <li>
                    <a @click="openEditForm">
                        <i class="fa fa-edit"></i>
                        Edit</a>
                </li>
                <li>
                    <a @click="openComments">
                        <span v-if="proposal && unreadComments > 0"
                              class="badge badge-danger pull-left">{{unreadComments}}</span>
                        <icon icon="comments"></icon>
                        Comments
                    </a>
                </li>
            </ul>
        </nav>

        <div class="wrapper wrapper-content">
            <map-controls @edit="openBillboardFaceForm"
                          @remove="removeBillboardFace"
                          @centerFace="centerFace"
                          @reordered="reorderBillboardFaces"></map-controls>
            <gmap-map
                    v-if="loaded"
                    ref="map"
                    :options="mapOptions"
                    :center="center"
                    :zoom="10">
                <gmap-marker
                        v-for="m in markers"
                        :key="m.billboard.id"
                        :position="m.position"
                        :icon="markerIcon(m)"
                        :clickable="true"
                        @click="openInfoWindow(m)">
                </gmap-marker>
                <gmap-info-window
                        ref="gmapInfoWindow"
                        :opened="(billboard !== null)"
                        :position="(billboard !== null) ? billboard.position : null"
                        @closeclick="closeInfoWindow">
                    <billboard-show v-if="billboard" @add="openBillboardFaceForm"></billboard-show>
                </gmap-info-window>
            </gmap-map>
            <filters @updated="fitToMarkers" :show="showFilters"></filters>
        </div>
        <proposal-form ref="form" @saved="formSaved"></proposal-form>
        <billboard-face-form ref="billboardFaceForm" @created="faceCreated"
                             @updated="faceUpdated"></billboard-face-form>
        <comments ref="comments"></comments>
    </div>
</template>
<style lang="scss">
    .proposal-list {
        position: relative;

        .wrapper.wrapper-content {
            position: relative;
            padding: 30px 0 0 0;
        }

        .vue-map-container {
            width: 100%;
            height: calc(100vh - 236px);
        }
    }
</style>
<script>

    import * as SLC from "../../vue/http";
    import BillboardShow from './show/billboard-show';
    import MapControls from './show/map-controls';
    import BillboardFaceForm from './show/billboard-face-form';
    import ProposalForm from './proposal-form';
    import store from './show/store';
    import Comments from './show/comments';
    import Filters from './show/filters';

    export default {
        props     : {
            id: {required: true},
        },
        store,
        components: {
            BillboardShow,
            MapControls,
            BillboardFaceForm,
            ProposalForm,
            Comments,
            Filters,
        },
        data() {
            return {
                pageHeading         : {
                    title     : 'Loading...',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')},
                        {title: 'Proposal List', url: laroute.route('proposals.index')}
                    ]
                },
                loaded              : false,
                center              : null,
                zoom                : null,
                mapOptions          : {
                    scrollWell     : true,
                    mapTypeControl : false,
                    gestureHandling: 'greedy',
                },
                infoWindowPos       : null,
                gmapInfoWindowClosed: false,
                showFilters         : false,
            }
        },

        computed: {
            user() {
                return this.$store.state.user;
            },
            billboard() {
                return this.$store.state.billboard;
            },
            billboards() {
                return this.$store.state.billboards;
            },
            markers() {
                return this.$store.getters.markers;
            },
            proposal() {
                return this.$store.state.proposal;
            },
            unreadComments() {
                const comments = this.$store.state.proposal.comments;
                let total = 0;
                for (let i = 0; i < comments.length; i++) {
                    const comment = comments[i];
                    if (comment.visualized) {
                        continue;
                    }
                    if (comment.user_id && comment.user_id === this.$root.user.id) {
                        continue;
                    }
                    total++;
                }
                return total;
            },
        },

        created() {
            this.$store.dispatch('getUser');
            this.$store.dispatch('getProposal', this.id);
        },

        mounted() {
            const self = this;
            this.getComments();
            window.EventBus.$on('CommentCreated', (e) => {
                console.log("CommentCreated", e.comment);
                if (e.comment.proposal_id === self.proposal.id && self.$root.user.id !== e.comment.user_id) {
                    self.$store.dispatch('addComment', e.comment);
                }
            });
            this.center = {
                lat: parseFloat(this.user.lat),
                lng: parseFloat(this.user.lng),
            };
            this.zoom = this.user.zoom;
            this.loaded = true;
            this.$store.watch(state => {
                    return state.proposal;
                },
                () => {
                    if (!self.$store.state.proposal) {
                        return;
                    }
                    this.pageHeading.title = self.$store.state.proposal.name;
                },
                {
                    deep: true
                });
        },

        methods: {
            openComments() {
                const uri = laroute.route('api.update.comments', {proposal: this.proposal.id});
                SLC.put(uri, new SlcForm({})).then(response => {
                    console.log("Comments", response);
                    this.$store.dispatch('viewMessages');
                    this.$refs.comments.show();
                });
            },
            markerIcon(marker) {
                let fillColor = '#42c0fb';
                const markerFaces = marker.billboard.billboard_faces;
                const proposalFaces = this.proposal.billboard_faces;
                for (let i = 0; i < proposalFaces.length; i++) {
                    const pf = proposalFaces[i];
                    for (let j = 0; j < markerFaces.length; j++) {
                        const mf = markerFaces[j];
                        if (pf.id === mf.id) {
                            fillColor = '#999';
                            break;
                        }
                    }
                }

                return {
                    path        : "M 13.24,29.00\n" +
                    "           C 11.29,25.16 9.45,22.37 8.81,18.00\n" +
                    "             5.47,-4.64 38.39,-6.24 39.40,14.00\n" +
                    "             39.62,18.39 38.18,22.10 36.36,26.00\n" +
                    "             34.57,29.84 33.75,31.84 30.00,34.00\n" +
                    "             28.98,30.76 27.51,27.46 27.82,24.00\n" +
                    "             28.16,20.13 31.19,15.99 28.97,12.15\n" +
                    "             26.13,7.21 17.79,8.78 18.27,16.00\n" +
                    "             18.63,21.51 27.25,33.47 28.12,38.00\n" +
                    "             28.80,41.52 26.51,44.93 25.00,48.00\n" +
                    "             25.00,48.00 23.00,48.00 23.00,48.00\n" +
                    "             23.00,48.00 13.24,29.00 13.24,29.00 Z",
                    fillColor   : fillColor,
                    fillOpacity : 1,
                    strokeWeight: 0,
                    scale       : 1,
                    origin      : new google.maps.Point(4, 0),
                    anchor      : new google.maps.Point(24, 48),
                };
            },
            openEditForm() {
                this.$refs.form.show(this.proposal);
            },
            formSaved(proposal) {
                console.log("formSaved", proposal);
                this.pageHeading.title = proposal.name;
                this.$store.dispatch('getProposal', this.id);
            },
            openInfoWindow(marker) {
                console.log("Open Info Window", marker.billboard);
                if (this.gmapInfoWindowClosed) {
                    this.gmapInfoWindowClosed = false;
                    this.$refs.gmapInfoWindow.createInfoWindow();
                }
                this.$store.dispatch('setBillboard', marker.billboard);
            },
            closeInfoWindow() {
                console.log("Close Info Window");
                this.$store.dispatch('setBillboard', null);
            },
            openBillboardFaceForm(face) {
                console.log("Open Billboard Face Form");
                this.$refs.gmapInfoWindow.$infoWindow.close();
                this.gmapInfoWindowClosed = true;
                this.$refs.billboardFaceForm.show(face);
            },
            removeBillboardFace(face) {
                console.log("Remove face", face);
                this.$store.dispatch('removeBillboardFace', face);
            },
            faceCreated(face) {
                this.$store.dispatch('faceCreated', face);
            },
            faceUpdated(face) {
                this.$store.dispatch('faceUpdated', face);
            },
            reorderBillboardFaces(orderList) {
                console.log("Order changed", orderList);
                const form = new SlcForm({
                    proposal_id: this.proposal.id,
                    orderList  : orderList,
                });

                this.$store.dispatch('reorderBillboardFaces', form);
            },
            centerFace(face) {
                console.log('Center face', face);
                for (let i = 0; i < this.markers.length; i++) {
                    const billboard = this.markers[i].billboard;
                    if (billboard.id === face.billboard_id) {
                        if (this.gmapInfoWindowClosed) {
                            this.gmapInfoWindowClosed = false;
                            this.$refs.gmapInfoWindow.createInfoWindow();
                        }
                        this.$store.dispatch('setBillboard', billboard);
                        break;
                    }
                }
            },
            getComments() {
                const uri = laroute.route('api.comments.get.not.visualized', {id: this.id});
                SLC.get(uri).then(response => {
                    this.commentsView = response;
                });
            },
            fitToMarkers() {
                const bounds = new google.maps.LatLngBounds();
                const markers = this.$store.getters.markers;
                for (let i = 0; i < markers.length; i++) {
                    const marker = markers[i];
                    bounds.extend(marker.position);
                }
                this.$refs.map.fitBounds(bounds);
            },
        }
    }
</script>