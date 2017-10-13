<template>
    <div>
        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <box>
                    <box-content>
                        <h2 align="center">Billboard Information</h2>
                        <hr/>
                        <h4>Name</h4>
                        <p class="name">{{billboard.name}}</p>
                        <hr/>

                        <h4>Description</h4>
                        <p class="description">{{billboard.description}}</p>
                        <hr/>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Localization in Map</h4>
                                <hr/>
                                <gmap-map
                                        v-if="loaded"
                                        :center="center"
                                        :zoom="zoom"
                                        @click="onMapClick"
                                        @zoom_changed="onZoomChanged"
                                        :options="mapOptions"
                                        style="width: 100%; min-height: 350px">
                                    <gmap-marker
                                            v-if="marker"
                                            :position="marker"
                                            :icon="markerIcon"
                                            :clickable="true"
                                            :draggable="true"
                                            @dragend="onMarkerMoved"
                                            @click="center=marker"
                                    ></gmap-marker>
                                </gmap-map>
                            </div>
                            <div class="col-md-6">
                                <h4>Street View</h4>
                                <hr/>
                                <gmap-street-view-panorama
                                        v-if="loaded"
                                        class="pano"
                                        :position="center"
                                        :pov="pov"
                                        :zoom="1"
                                        @pano_changed="updatePano"
                                        @pov_changed="updatePov">
                                </gmap-street-view-panorama>
                            </div>
                        </div>
                    </box-content>
                </box>
                <row>
                    <h2 align="center">Billboard Faces</h2>
                    <faces-billboard :billboardId="this.id"></faces-billboard>
                </row>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped="scoped">
    .top-navigation .wrapper.wrapper-content {
        padding-top: 0;
    }

    .margin-billboard-edit {
        margin-right: 5px;
    }

    .vue-street-view-pano-container {
        min-height: 360px;
    }

</style>

<script>

    import _ from 'lodash';
    import * as Slc from "../../vue/http";
    import FacesBillboard from '../billboard-public/faces-billboard';

    export default {

        props: {
            id: {required: true},
        },

        components: {
            FacesBillboard,
        },

        data() {
            return {

                loaded: false,
                marker: null,
                zoom: 12,
                center: null,
                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },
                pov: null,
                pano: null,
                zoomChanged: false,
                billboard: {},
                billboardListRoute: laroute.route('billboards.index'),
                markerIcon: {
                    url: '/images/pin.png',
                    size: {width: 48, height: 48, f: 'px', b: 'px'},
                    scaledSize: {width: 48, height: 48, f: 'px', b: 'px'}
                },
            }
        },

        watch: {
            'form.address': function () {
                this.onAddressChange();
            }
        },

        created() {
            this.load();
        },

        methods: {
            load() {
                this.loaded = false;

                const uri = laroute.route('api.billboard.show', {billboard: this.id});
                Slc.find(uri).then((billboard) => {
                    console.log("Billboard loaded", billboard);
                    this.billboard = billboard;
                    this.center = billboard.position;
                    this.marker = billboard.position;
                    this.pov = billboard.pov;
                    this.loaded = true;
                });
            },

            reloadForm() {
                //this.form.he this.pov.heading;
            },


            onMapClick(e) {

                const self = this;

            },

            onZoomChanged(e) {

            },

            onAddressChange: _.debounce(function (e) {

            }, 500),

            onMarkerMoved: _.debounce(function (e) {

            }),

            updatePov(pov) {

            },

            updatePano(pano) {

            }
        }
    }

</script>