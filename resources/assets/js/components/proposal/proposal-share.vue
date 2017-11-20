<template>
    <div class="proposal-share">
        <div class="wrapper wrapper-content">
            <map-controls @centerFace="centerFace"></map-controls>
            <gmap-map
                    v-if="loaded"
                    :options="mapOptions"
                    :center="center"
                    :zoom="10">
                <gmap-marker
                        v-for="m in markers"
                        :key="m.face.id"
                        :position="m.face.position"
                        :icon="markerIcon(m)"
                        :clickable="true"
                        @click="openInfoWindow(m)">
                </gmap-marker>
                <gmap-info-window
                        ref="gmapInfoWindow"
                        :opened="(face !== null)"
                        :position="(face !== null) ? face.position : null"
                        @closeclick="closeInfoWindow">
                    <billboard-show v-if="face"></billboard-show>
                </gmap-info-window>
            </gmap-map>
        </div>
    </div>
</template>
<style lang="scss">
    .proposal-share {
        position: relative;

        .wrapper.wrapper-content {
            position: relative;
            padding: 0;
        }

        .vue-map-container {
            width: 100%;
            height: calc(100vh);
        }
    }
</style>
<script>

    import * as Slc from "../../vue/http";
    import BillboardShow from './share/billboard-show';
    import MapControls from './share/map-controls';
    import store from './share/store';

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
                loaded: false,
                center: null,
                zoom: null,
                mapOptions: {
                    scrollWell: true,
                    mapTypeControl: false,
                    gestureHandling: 'greedy',
                },
                infoWindowPos: null,
            }
        },

        computed: {
            face() {
                return this.$store.state.face;
            },
            markers() {
                return this.$store.state.markers;
            },
            proposal() {
                return this.$store.state.proposal;
            }
        },

        created() {
            this.$store.dispatch('setId', this.id);
            this.$store.dispatch('getProposal', this.id);
        },

        mounted() {
            const self = this;
            this.$store.watch(state => {
                    return state.proposal;
                },
                () => {
                    console.log('Proposal changed');
                    if (!self.proposal) {
                        return;
                    }
                    const faces = self.proposal.billboard_faces;
                    let center = {lat: null, lng: null};
                    if (faces.length) {
                        const face = faces[0];
                        center = face.position;
                    }

                    self.center = center;
                    self.zoom = 12;
                    self.loaded = true;
                },
                {
                    deep: true
                });
        },

        methods: {
            markerIcon(marker) {
                let fillColor = '#42c0fb';
                return {
                    path: "M 13.24,29.00\n" +
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
                    fillColor: fillColor,
                    fillOpacity: 1,
                    strokeWeight: 0,
                    scale: 1,
                    origin: new google.maps.Point(4, 0),
                    anchor: new google.maps.Point(24, 48),
                };
            },
            openInfoWindow(marker) {
                console.log("Open Info Window", marker.face);
                this.$store.dispatch('setFace', marker.face);
            },
            closeInfoWindow() {
                console.log("Close Info Window");
                this.$store.dispatch('setFace', null);
            },
            centerFace(face) {
                this.center = face.position;
                //this.$store.dispatch('setFace', face);
            }
        }
    }
</script>