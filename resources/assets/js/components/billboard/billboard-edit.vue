<template>
    <div>

        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>

        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <box>
                    <box-content>
                        <form-submit v-model="form" @submit="save">
                            <div class="row">
                                <div class="col-md-6">
                                    <form-group :form="form" field="name">
                                        <input-label for="name">Name: </input-label>
                                        <input-text v-model="form.name" id="name" name="name"></input-text>
                                    </form-group>
                                    <form-group :form="form" field="description">
                                        <input-label for="description">Description: </input-label>
                                        <text-area v-model="form.description" id="description"
                                                   name="description"></text-area>
                                    </form-group>
                                    <form-group :form="form" field="address">
                                        <input-label for="address">Address: </input-label>
                                        <input-text v-model="form.address" id="address" name="address"></input-text>
                                    </form-group>

                                    <gmap-map
                                            v-if="loaded"
                                            :center="center"
                                            :zoom="zoom"
                                            @click="onMapClick"
                                            @zoom_changed="onZoomChanged"
                                            :options="mapOptions"
                                            style="width: 100%; min-height: 320px">
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
                                    <hr />
                                    <gmap-street-view-panorama
                                            v-if="loaded"
                                            class="pano"
                                            :position="center"
                                            :pov="pov"
                                            :zoom="1"
                                            @pano_changed="updatePano"
                                            @pov_changed="updatePov">
                                    </gmap-street-view-panorama>

                                    <form-group :form="form" field="lat">
                                        <input-label for="lat">Latitude: </input-label>
                                        <input-text v-model="form.lat" id="lat" name="lat"></input-text>
                                    </form-group>

                                    <form-group :form="form" field="lng">
                                        <input-label for="lng">Longitude: </input-label>
                                        <input-text v-model="form.lng" id="lng" name="lng"></input-text>
                                    </form-group>
                                </div>
                                <div class="col-md-6" v-if="form.id">
                                    <form-group :form="form" field="billboardFaces">
                                        <billboard-face-list :billboardId="form.id"></billboard-face-list>
                                    </form-group>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <btn-submit :disabled="form.busy">
                                        <spinner v-if="form.busy"></spinner>
                                    </btn-submit>
                                    <a class="btn btn-default" :href="billboardListRoute">Cancel</a>
                                </div>
                            </div>
                        </form-submit>
                    </box-content>
                </box>
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
    import BillboardFaceList from '../billboard-face/billboard-face-list';
    export default {
        props: {
            id: {required: true},
        },
        components: {
            BillboardFaceList
        },
        data() {
            return {
                form: new SlcForm({}),
                loaded: false,
                marker: null,
                markerIcon: {
                    url: 'http://signly.dev/images/pin.png',
                    size: {width: 48, height: 48, f: 'px', b: 'px'},
                    scaledSize: {width: 48, height: 48, f: 'px', b: 'px'}
                },
                zoom: 7,
                center: null,
                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },
                pov: null,
                pano: null,
                zoomChanged: false,
                billboardFaces: [],
                billboardListRoute: laroute.route('billboards.index'),
                pageHeading: {
                    title: 'Billboard Edit',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')},
                        {title: 'Billboard List', url: laroute.route('billboards.index')}
                    ]
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
                    this.center = billboard.position;
                    this.marker = billboard.position;
                    this.pov = billboard.pov;
                    this.form = new SlcForm({
                        id: billboard.id,
                        name: billboard.name,
                        description: billboard.description,
                        address: billboard.address,
                        lat: billboard.lat,
                        lng: billboard.lng,
                        heading: billboard.heading,
                        pitch: billboard.pitch
                    });
                    this.loaded = true;
                });
            },
            reloadForm() {
                //this.form.he this.pov.heading;
            },
            save() {
                const uri = laroute.route('api.billboard.update', {billboard: this.form.id});
                Slc.put(uri, this.form).then((response) => {
                    console.log('Billboard Updated:', response);
                });
            },
            buildForm(billboard) {
                this.address = null;
                this.zoomChanged = false;
                return new SlcForm({
                    id: billboard.id,
                    name: billboard.name,
                    description: billboard.description,
                    digital_driveby: billboard.digital_driveby,
                    address: billboard.address,
                    lat: billboard.lat,
                    lng: billboard.lng,
                });
            },
            onMapClick(e) {
                const self = this;
                console.log(e);
                if (this.marker) {
                    return;
                }
                const geocoder = new google.maps.Geocoder;
                const pos = {
                    lat: e.latLng.lat(),
                    lng: e.latLng.lng(),
                };
                geocoder.geocode({'location': pos}, (results, status) => {
                    console.log("Geocode", results, status);
                    if (!results.length || status !== 'OK') {
                        return;
                    }
                    if (self.form.address) {
                        return;
                    }
                    const result = results[0];
                    self.form.address = result.formatted_address;
                    self.form.lat = pos.lat;
                    self.form.lng = pos.lng;
                });
                this.marker = pos;
                this.center = pos;
                if (self.zoomChanged) {
                    return;
                }
                this.zoom = 15;
            },
            onZoomChanged(e) {
                console.log("On Zoom Changed", e);
                this.zoomChanged = true;
            },
            onAddressChange: _.debounce(function (e) {
                console.log("OnAddressChange", e);
                const self = this;
                const geocoder = new google.maps.Geocoder;
                geocoder.geocode({address: self.form.address}, (results, status) => {
                    console.log("Geocode From Address", results, status);
                    if (!results.length || status !== 'OK') {
                        return;
                    }
                    const result = results[0];
                    const location = result.geometry.location;
                    const pos = {
                        lat: location.lat(),
                        lng: location.lng(),
                    };
                    self.form.lat = pos.lat;
                    self.form.lng = pos.lng;
                    self.marker = pos;
                    self.center = pos;
                    if (self.zoomChanged) {
                        return;
                    }
                    self.zoom = 15;
                });
            }, 500),
            onMarkerMoved: _.debounce(function (e) {
                console.log('On Marker Moved', e);
                const pos = {
                    lat: e.latLng.lat(),
                    lng: e.latLng.lng(),
                };
                this.form.lat = pos.lat;
                this.form.lng = pos.lng;
                this.marker = pos;
                this.center = pos;
            }),
            updatePov(pov) {
                console.log('Pov Changed: ', pov);
                this.pov = pov;
                this.form.heading = pov.heading;
                this.form.pitch = pov.pitch;
            },
            updatePano(pano) {
                this.pano = pano;
            }
        }
    }
</script>