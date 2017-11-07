<template>

    <div class="proposal-list">
        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>

        <nav class="navbar navbar-in-content navbar-default" data-spy="affix" data-offset-top="147">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a>
                        <i class="fa fa-share"></i>
                        Share</a>
                </li>
            </ul>
        </nav>

        <div class="wrapper wrapper-content">
            <map-controls></map-controls>

            <gmap-map
                    v-if="loaded"
                    :options="mapOptions"
                    :center="center"
                    :zoom="10">
                <gmap-marker
                        v-for="m in markers"
                        :key="m.billboard.id"
                        :position="m.position"
                        :icon="markerIcon"
                        :clickable="true"
                        @click="openInfoWindow(m)">
                </gmap-marker>
                <gmap-info-window
                        :opened="(billboard !== null)"
                        :position="(billboard !== null) ? billboard.position : null"
                        @closeclick="closeInfoWindow">
                    <billboard-show v-if="billboard"></billboard-show>
                </gmap-info-window>
            </gmap-map>
        </div>
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

    import * as Slc from "../../vue/http";
    import BillboardShow from './show/billboard-show';
    import MapControls from './show/map-controls';
    import store from './show/store';

    export default {
        props: {
            id: {required: true},
        },
        store,
        components: {
            BillboardShow,
            MapControls,
        },
        data() {
            return {
                pageHeading: {
                    title: 'Loading...',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')},
                        {title: 'Proposal List', url: laroute.route('proposals.index')}
                    ]
                },

                loaded: false,
                center: null,
                zoom: null,
                mapOptions: {
                    scrollWell: true,
                    mapTypeControl: false,
                    gestureHandling: 'greedy',
                },

                markerIcon: {
                    url: '/images/pin.png',
                    size: {width: 48, height: 48, f: 'px', b: 'px'},
                    scaledSize: {width: 48, height: 48, f: 'px', b: 'px'}
                },
                infoWindowPos: null,
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
                return this.$store.state.markers;
            }
        },

        created() {
            this.$store.dispatch('getUser');
            this.$store.dispatch('getProposal', this.id);
            this.$store.dispatch('getBillboards');
        },

        mounted() {
            const self = this;
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
                })
        },

        methods: {
            openInfoWindow(marker) {
                console.log("Open Info Window", marker.billboard);
                this.$store.dispatch('setBillboard', marker.billboard);
            },
            closeInfoWindow() {
                console.log("Close Info Window");
                this.$store.dispatch('setBillboard', null);
            },
        }
    }
</script>