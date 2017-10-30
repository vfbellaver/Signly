<template>
    <div>
        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <box>
                    <box-content>

                        <hr/>
                        <row>
                            <column size="4">
                                <h2 class="font-bold m-b-xs">
                                    Team
                                </h2>
                                <hr>
                                <div class="col-sm-5">
                                    <div class="text-center">
                                        <img alt="image" class="img-responsive"
                                             :src="this.owner.photo_url" width="100%">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <h3><strong>{{this.teamOwner.name}}</strong></h3>
                                    <strong> <i class="fa fa-send"></i> Email:</strong><br>
                                    {{this.owner.email}}
                                    <br><br>
                                    <strong> <i class="fa fa-phone"></i> Phones:</strong><br>
                                    (123) 456-7890
                                    <br><br>
                                    <address>
                                        <strong> <i class="fa fa-map-marker"></i> Address:</strong><br>
                                        {{this.owner.address}}
                                    </address>
                                </div>
                                <div class="clearfix"></div>
                            </column>
                            <column size="8">
                                <h2 class="font-bold m-b-xs">
                                    Billboard Information
                                </h2>
                                <hr>

                                <h3>Billboard Name</h3>
                                <div class="text-muted">
                                    {{billboard.name}}
                                </div>
                                <br>
                                <h3>Billboard description</h3>
                                <div class="text-muted">
                                    {{billboard.description}}
                                </div>
                                <row>
                                    <dl class="m-t-md col-sm-4">
                                        <dt><i class="fa fa-map-marker"></i> Address</dt>
                                        <dd>{{billboard.address}}</dd>
                                    </dl>
                                    <dl class="m-t-md col-sm-2">
                                        <dt><i class="fa fa-arrows-v"></i> Latitude</dt>
                                        <dd>{{billboard.lat}}</dd>
                                    </dl>
                                    <dl class="m-t-md col-sm-2">
                                        <dt><i class="fa fa-arrows-h"></i> Longitude</dt>
                                        <dd>{{billboard.lng}}</dd>
                                    </dl>
                                </row>

                            </column>
                        </row>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                                <gmap-map
                                        v-if="loaded"
                                        :center="center"
                                        :zoom="zoom"
                                        @zoom_changed="onZoomChanged"
                                        :options="mapOptions"
                                        style="width: 100%; min-height: 500px;">
                                    <gmap-marker
                                            v-if="marker"
                                            :position="marker"
                                            :icon="markerIcon"
                                    ></gmap-marker>
                                </gmap-map>
                            </div>
                            <div class="col-md-12">
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
                    <h1 align="center">Billboard Faces</h1>
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
        min-height: 500px;
    }

    .vue-map-container .map-vue {
        left: 10px;
        right: 10px;
        top: 30px;
        bottom: 0;
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
                owner: {},
                teamOwner: {},
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

        mounted() {
            this.load();
        },

        methods: {
            load() {
                this.loaded = false;
                const uri = laroute.route('public.get.billboard', {billboard: this.id});
                Slc.get(uri).then((response) => {
                    console.log("Billboard Public", response[0]);
                    this.billboard = response[0];
                    this.center = response[0].position;
                    this.marker = response[0].position;
                    this.pov = response[0].pov;
                    this.owner = response[0].user;
                    this.teamOwner = response[0].team;
                    this.loaded = true;
                });
            },

            onMapClick(e) {

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