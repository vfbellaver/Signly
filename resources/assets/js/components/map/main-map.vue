<template>
    <gmap-map
            v-if="loaded"
            :options="mapOptions"
            :center="center"
            :zoom="10">
        <gmap-info-window
                :options="infoOptions"
                :position="infoWindowPos"
                :opened="infoWinOpen"
                @closeclick="infoWinOpen=false">
            <billboard-info :billboardFaces="billboardFaces"></billboard-info>
        </gmap-info-window>
        <gmap-marker
                :key="i"
                v-for="(m,i) in markers"
                :position="m.position"
                :clickable="true"
                @click="toggleInfoWindow(m,i)">
        </gmap-marker>
    </gmap-map>
</template>

<style>
    .vue-map-container {
        width: 100%;
        height: 90vmin;
    }
</style>

<script>

    import _ from 'lodash';
    import * as Slc from "../../vue/http";
    import BillboardInfo from './billboard-info';

    export default {

        props: {
            user: {required: true}
        },

        components: {
            BillboardInfo
        },

        data() {
            return {
                loaded: false,
                billboards: [],
                billboardFaces: [],
                billboard: null,

                center: null,
                markers: [],
                zoom: null,
                mapOptions: {
                    scrollWell: true,
                    mapTypeControl: false,
                    gestureHandling: 'greedy',
                },

                infoShow: false,
                infoWinOpen: false,
                infoWindowPos: null,
                infoOptions: {
                    maxWidth: 800,
                    width: 800,
                    minHeight: 600,
                    height: 600,
                },
            }
        },

        created() {
            this.center = {
                lat: parseFloat(this.user.lat),
                lng: parseFloat(this.user.lng),
            };
            this.zoom = this.user.zoom;
            this.loaded = true;
            this.loadMarkers();
        },

        methods: {

            loadMarkers() {
                Slc.get(laroute.route('api.billboard.index'))
                    .then((response) => {
                        this.billboards = response;
                        for (let i = 0; i < this.billboards.length; i++) {
                            this.markers.push({
                                position: {
                                    lat: parseFloat(this.billboards[i].lat),
                                    lng: parseFloat(this.billboards[i].lng)
                                },
                                infoText: this.billboards[i],
                            });
                        }
                    });
            },

            toggleInfoWindow: function (marker, idx) {

                console.log('Billboard Id ', this.billboard.id);

                this.infoWindowPos = marker.position;
                this.billboard = marker.infoText;
                this.loadFaces(this.billboard.id);

                if (this.currentMidx === idx) {
                    this.infoWinOpen = !this.infoWinOpen;
                }
                else {
                    this.infoWinOpen = true;
                    this.currentMidx = idx;
                }
            },

            loadFaces(billboardId) {
                Slc.get(laroute.route('api.billboard-face.index', {bid: billboardId}))
                    .then((response) => {
                        console.log('Response ', response);
                        this.billboardFaces = response;
                    });
            },

        }
    }
</script>