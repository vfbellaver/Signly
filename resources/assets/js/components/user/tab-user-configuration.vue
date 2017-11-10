<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Default Map Center
                </h5>
            </div>
            <div class="ibox-content">
                <row>
                    <div class="col-xs-12">
                        <gmap-map
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
                    </div>
                </row>
                <row>
                    <div class="col-xs-12">
                        <hr class="hr">
                        <button class="btn btn-success" @click="save">
                            Define
                        </button>
                    </div>
                </row>
            </div>
        </div>
<!--
        <div class="ibox">
            <div class="ibox-title">
                <h5>Invoice List
                </h5>
            </div>
            <div class="ibox-content">
                <row>
                    <div class="col-xs-12">
                        <select-utc></select-utc>
                    </div>
                </row>
                <row>
                    <div class="col-xs-12">
                        <hr class="hr">
                        <button class="btn btn-success" @click="saveUtc">
                            Save
                        </button>
                    </div>
                </row>
            </div>
        </div>
-->
    </div>
</template>
<style lang="scss" scoped="scoped">
    .table {
        margin-top: 10px;
    }

    .ibox {
        clear: none;
        margin-bottom: 60px;
        margin-top: 0px;
        padding: 0;
    }

    .ibox-content {
        clear: none;
    }
</style>

<script>

    import * as SLC from '../../vue/http';
    import SelectUtc from './partials/select-utc';

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
                zoom: 20,
                center: {lat: Slc.user.lat, lng: Slc.user.lng},
                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },
                zoomChanged: false,
                gestureHandling: 'greedy',
                user: null,
            }
        },

        created(){
            this.user = new SlcForm({
                id: Slc.user.id,
                lat: Slc.user.lat,
                lng: Slc.user.lng,
                timezone: Slc.user.timezone,
            });
        },

        methods: {

            save() {
                const uri = laroute.route('api.user.update.location', {user: this.user.id});
                SLC.put(uri, this.user).then((response) => {
                    console.log('Updated Location ', response);
                });
            },

            saveUtc() {
                const uri = laroute.route('api.user.update.location', {user: this.user.id});
                SLC.put(uri, this.user).then((response) => {
                    console.log('Updated Location ', response);
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
                    const result = results[0];
                    self.user.lat = pos.lat;
                    self.user.lng = pos.lng;
                    self.getTimeZone(pos);
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
                    self.user.lat = pos.lat;
                    self.user.lng = pos.lng;
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
                this.user.lat = pos.lat;
                this.user.lng = pos.lng;
                this.getTimeZone(pos);
                this.marker = pos;
                this.center = pos;
            }),

            getTimeZone(pos){
                const uri = laroute.route('api.user.get.timezone',{lat:pos.lat,lng:pos.lng,time: moment.utc().seconds()});
                SLC.get(uri).then((response) => {
                   this.user.timezone = response.data.timeZoneId;
                    console.log(momentTZ.tz(this.user.timezone).format("YYYY-MM-DD HH:mm Z"));
                    this.user.timezone = momentTZ.tz(this.user.timezone).format("YYYY-MM-DD HH:mm");
                });
            }
        }
    }
</script>