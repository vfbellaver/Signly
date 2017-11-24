<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Default Location
                </h5>
            </div>
            <div class="ibox-content">
                <row>
                    <div class="col-xs-12">
                        <form-submit v-model="user" @submit="save">

                            <form-group :form="user" field="address">
                                <input-label for="address">Address: </input-label>
                                <input-text v-model="user.address" id="address" name="address"></input-text>
                            </form-group>

                            <gmap-map
                                    v-if="loaded"
                                    :center="center"
                                    :zoom="zoom"
                                    @click="onMapClick"
                                    @zoom_changed="onZoomChanged"
                                    :options="mapOptions"
                                    style="width: 100%; min-height: 400px">
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

                            <hr/>
                            <row>
                                <div class="col-xs-6 col-sm-6">
                                    <form-group :form="user" field="lat">
                                        <input-label for="lat">Latitude: </input-label>
                                        <input-text v-model="user.lat" id="lat" name="lat"></input-text>
                                    </form-group>
                                </div>
                                <div class="col-xs-6 col-sm-6">
                                    <form-group :form="user" field="lng">
                                        <input-label for="lng">Longitude: </input-label>
                                        <input-text v-model="user.lng" id="lng" name="lng"></input-text>
                                    </form-group>
                                </div>
                            </row>
                        </form-submit>
                    </div>
                </row>
                <row>
                    <div class="col-xs-12">
                        <hr class="hr">
                        <button class="btn btn-primary" @click="save" :disabled="user.busy">
                            <spinner v-if="user.busy"></spinner>
                            Define
                        </button>
                    </div>
                </row>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped="scoped">
    .table {
        margin-top: 10px;
    }

    .ibox {
        clear: none;
        margin-bottom: 60px;
        margin-top: -20px;
        padding: 0;
    }

    .ibox-content {
        clear: none;
    }


</style>

<script>
    import * as SLC from '../../vue/http';
    import SelectUtc from './partials/select-utc';
    import * as _ from "lodash";

    export default {
        components: {
            SelectUtc,
        },
        data() {
            return {
                marker: null,
                markerIcon: {
                    url: '/images/pin.png',
                    size: {width: 48, height: 48, f: 'px', b: 'px'},
                    scaledSize: {width: 48, height: 48, f: 'px', b: 'px'}
                },
                zoom: 12,
                center: {lat: Slc.user.lat, lng: Slc.user.lng},
                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },
                zoomChanged: false,
                gestureHandling: 'greedy',
                user: null,
                loaded: null,
                position: null,
            }
        },
        created() {
            this.user = new SlcForm({
                id: Slc.user.id,
                lat: Slc.user.lat,
                lng: Slc.user.lng,
                address: Slc.user.address,
            });

            this.position = {lat: Slc.user.lat, lng: Slc.user.lng};
        },
        mounted() {
            this.load();
        },
        watch: {
            'user.address': function () {
                this.onAddressChange();
            }
        },
        methods: {
            save() {
                const uri = laroute.route('api.user.update.location', {user: this.user.id});
                SLC.put(uri, this.user).then((response) => {
                    console.log('Updated Location ', response);
                });
            },

            load() {
                this.loaded = false;
                console.log("User loaded", this.position);
                this.center = this.position;
                this.marker = this.position;
                console.log("User center", this.center);
                this.loaded = true;
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
                    if (self.user.address) {
                        return;
                    }
                    const result = results[0];
                    self.user.address = result.formatted_address;
                    self.user.lat = pos.lat;
                    self.user.lng = pos.lng;
                });
                this.marker = pos;
                this.center = pos;
                if (self.zoomChanged) {
                    return;
                }
                this.zoom = 15;
                console.log('On click Billboard', this.user);
            },
            onZoomChanged(e) {
                console.log("On Zoom Changed", e);
                this.zoomChanged = true;
            },
            onAddressChange: _.debounce(function (e) {
                console.log("OnAddressChange", e);
                const self = this;
                const geocoder = new google.maps.Geocoder;
                geocoder.geocode({address: self.user.address}, (results, status) => {
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
                    self.user.lat = pos.lat;
                    self.user.lng = pos.lng;
                    self.marker = pos;
                    self.center = pos;
                    self.streetViewLoaded = false;
                    self.$nextTick(() => {
                        self.streetViewLoaded = true;
                    });
                    if (self.zoomChanged) {
                        return;
                    }
                    self.zoom = 15;
                    console.log('On address Changed Billboard', this.user);
                });
            }, 500),

            onMarkerMoved: _.debounce(function (e) {
                console.log('On Marker Moved', e);
                const pos = {
                    lat: e.latLng.lat(),
                    lng: e.latLng.lng(),
                };
                this.user.lat = pos.lat;
                this.user.lng = pos.lng;
                this.marker = pos;
                this.center = pos;
                console.log('Is center chaged', this.center);
                this.streetViewLoaded = false;
                this.$nextTick(() => {
                    this.streetViewLoaded = true;
                });
                console.log('On marker Moved Billboard', this.user);
            }),

            getTimeZone(pos) {
                const uri = laroute.route('api.user.get.timezone', {
                    lat: pos.lat,
                    lng: pos.lng,
                    time: moment.utc().seconds()
                });
                SLC.get(uri).then((response) => {
                    this.user.timezone = response.data.timeZoneId;
                    console.log(momentTZ.tz(this.user.timezone).format("YYYY-MM-DD HH:mm Z"));
                    this.user.timezone = momentTZ.tz(this.user.timezone).format("YYYY-MM-DD HH:mm");
                });
            }
        }
    }
</script>