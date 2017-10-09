<template>
    <div>
        <box>
            <box-title>Create New Billboard</box-title>
            <box-content>
                <form-submit v-model="form" @submit="save">
                    <div class="row">
                        <div class="col-md-12">
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
                                    :center="center"
                                    :zoom="zoom"
                                    @click="onMapClick"
                                    @zoom_changed="onZoomChanged"
                                    :options="mapOptions"
                                    style="width: 100%; min-height: 320px">
                                <gmap-marker
                                        v-if="marker"
                                        :position="marker"
                                        :clickable="true"
                                        :draggable="true"
                                        @dragend="onMarkerMoved"
                                        @click="center=marker"
                                ></gmap-marker>
                            </gmap-map>

                            <form-group :form="form" field="lat">
                                <input-label for="lat">Latitude: </input-label>
                                <input-text v-model="form.lat" id="lat" name="lat"></input-text>
                            </form-group>

                            <form-group :form="form" field="lng">
                                <input-label for="lng">Longitude: </input-label>
                                <input-text v-model="form.lng" id="lng" name="lng"></input-text>
                            </form-group>

                            <form-group :form="form" field="digital_driveby">
                                <input-label for="digital_driveby">Digital Driveby: </input-label>
                                <input-url v-model="form.digital_driveby" id="digital_driveby"
                                           name="digital_driveby"></input-url>
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
</template>

<style lang="scss" scoped="true">
    .vue-map-container {
        min-height: 320px;
        margin-bottom: 12px;
    }
</style>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";
    import BillboardFaceList from '../billboard-face/billboard-face-list';

    export default {
        props: {
            mapCenter: {required: true}
        },
        components: {
            BillboardFaceList,
        },
        data() {
            return {
                form: null,
                marker: null,
                zoom: null,
                center: null,
                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },
                zoomChanged: false,
                billboardListRoute: laroute.route('billboards.index'),
            }
        },
        watch: {
            'form.address': function () {
                this.onAddressChange();
            }
        },
        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Add')} Billboard`;
            }
        },

        created() {
            this.marker = null;
            this.address = null;

            this.zoom = this.mapCenter.zoom;
            const lat = Number.parseFloat(this.mapCenter.lat);
            const lng = Number.parseFloat(this.mapCenter.lng);
            this.center = {lat: lat, lng: lng};

            this.form = new SlcForm({
                id: null,
                name: null,
                description: null,
                digital_driveby: null,
                address: null,
                lat: null,
                lng: null,
            });
        },

        methods: {
            save() {
                const uri = laroute.route('api.billboard.store');
                Slc.post(uri, this.form).then((response) => {
                    console.log('Billboard Create:', response);
                    window.location = laroute.route("billboards.edit", {billboard: response.data.id});
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
            }, 500),
        }
    }
</script>