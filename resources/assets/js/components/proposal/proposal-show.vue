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
            <map-controls :proposal="proposal"></map-controls>

            <gmap-map
                    v-if="loaded"
                    :options="mapOptions"
                    :center="center"
                    :zoom="10">
                <gmap-marker
                        :key="m.billboard.id"
                        v-for="m in markers"
                        :position="m.position"
                        :icon="markerIcon"
                        :clickable="true"
                        @click="openInfoWindow(m)">
                </gmap-marker>
                <gmap-info-window
                        :opened="(billboard !== null)"
                        :position="(billboard !== null) ? billboard.position : null"
                        @closeclick="billboard = null">
                    <billboard-show v-if="billboard" :user="this.user" :billboard="billboard"></billboard-show>
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

    export default {
        props: {
            id: {required: true},
        },
        components: {
            BillboardShow,
            MapControls,
        },
        data() {
            return {
                proposal: null,
                pageHeading: {
                    title: 'Loading...',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')},
                        {title: 'Proposal List', url: laroute.route('proposals.index')}
                    ]
                },
                loaded: false,
                billboards: [],
                billboard: null,

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
                markers: [],

                infoWindowPos: null,
            }
        },

        created() {
            const user = window.Slc.user;
            this.center = {
                lat: parseFloat(user.lat),
                lng: parseFloat(user.lng),
            };
            this.zoom = user.zoom;
            this.loaded = true;
        },

        mounted() {
            this.load();
            this.loadMarkers();
        },

        methods: {
            load() {
                Slc.find(laroute.route('api.proposal.show', {proposal: this.id}))
                    .then((response) => {
                        console.log("Load proposal ", response);
                        this.proposal = response;
                        this.pageHeading.title = response.name;
                    });
            },
            loadMarkers() {
                const uri = laroute.route('api.billboard.index');
                Slc.get(uri)
                    .then((response) => {
                        this.billboards = response;
                        for (let i = 0; i < this.billboards.length; i++) {
                            this.markers.push({
                                position: {
                                    lat: parseFloat(this.billboards[i].lat),
                                    lng: parseFloat(this.billboards[i].lng)
                                },
                                billboard: this.billboards[i],
                            });
                        }
                    });
            },
            openInfoWindow: function (marker) {
                console.log("Open Info Window", marker.billboard);
                this.billboard = marker.billboard;
            },
        }
    }
</script>