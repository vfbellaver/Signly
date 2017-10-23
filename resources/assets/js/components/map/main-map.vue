<template>
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
            <billboard-info v-if="billboard" :user="this.user" :billboard="billboard"></billboard-info>
        </gmap-info-window>
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
            this.center = {
                lat: parseFloat(this.user.lat),
                lng: parseFloat(this.user.lng),
            };
            this.zoom = this.user.zoom;
            this.loaded = true;
            if(this.user.email) {

                this.loadMarkers('api.billboard.index');
            }else{
                this.loadMarkers('public.billboard.page');
            }
        },

        methods: {

            loadMarkers(uri) {
                Slc.get(laroute.route(uri))
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