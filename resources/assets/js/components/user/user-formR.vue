<template>
    <div>
        <form-submit v-model="userForm" @submit="updateProfile">
            <h2><i class="fa fa-user"></i> User </h2>
            <div class="divider"></div>
            <column size="12">
                <form-group :form="userForm" field="name">
                    <input-label for="name">Name: </input-label>
                    <input-text v-model="userForm.name" id="name"
                                name="name"></input-text>
                </form-group>
            </column>
            <column size="12">
                <form-group :form="userForm" field="email">
                    <input-label for="email">Email: </input-label>
                    <input-text v-model="userForm.email" id="email"
                                name="email"></input-text>
                </form-group>
            </column>
            <h2><i class="fa fa-map-marker" aria-hidden="true"></i> Address </h2>
            <div class="divider"></div>
            <column size="12">
                <form-group :form="userForm" field="address">
                    <input-label for="address">Address: </input-label>
                    <input-text v-model="userForm.address" id="address" name="address"></input-text>
                </form-group>
            </column>
            <column size="12">
                <gmap-map
                        :center="center"
                        :zoom="zoom"
                        @click="onMapClick"
                        @zoom_changed="onZoomChanged"
                        :options="mapOptions"
                        style="width: 100%; min-height: 220px">
                    <gmap-marker
                            :position="marker"
                            :clickable="true"
                            :draggable="true"
                            @dragend="onMarkerMoved"
                            @click="center=marker"
                    ></gmap-marker>
                </gmap-map>
            </column>
            <div class="col-md-12">
                <hr>
                <btn-submit :disabled="userForm.busy">
                    <spinner v-if="userForm.busy"></spinner>
                </btn-submit>
            </div>
        </form-submit>
    </div>
</template>

<style>
    .divider {
        height: 3px;
        margin: 15px;
        background-color: rgba(2, 118, 160, 0.74);
        border-radius: 3px 3px 3px 3px;

    }
</style>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";

    export default {
        props: {
            user: {required: true},
        },
        components: {},

        data() {
            return {
                userForm: null,
                marker: null,
                center: null,
                zoom: 7,
                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },
                zoomChanged: false,
            }
        },

        created() {
            this.userForm = new SlcForm({
                name: this.user.name,
                email: this.user.email,
                address: this.user.address,
                lat: this.user.lat,
                lng: this.user.lng,
            });

            this.center = {lat: this.userForm.lat, lng: this.userForm.lng};
            this.marker = {lat: this.userForm.lat, lng: this.userForm.lng};
        },

        watch: {
            'userForm.address': function (value, oldValue) {
                if (!oldValue) {
                    return;
                }
                this.onAddressChange();
            },
        },
        methods: {
            updateProfile() {
                const uri = laroute.route('api.user.update', {user: this.user.id});
                Slc.put(uri, this.userForm).then((response) => {
                    console.log("User Update", response);
                    EventBus.$emit('userUpdated');
                })
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
                    if (self.userForm.address) {
                        return;
                    }
                    const result = results[0];
                    self.userForm.address = result.formatted_address;
                    self.userForm.lat = pos.lat;
                    self.userForm.lng = pos.lng;
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
                geocoder.geocode({address: self.userForm.address}, (results, status) => {
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
                    self.userForm.lat = pos.lat;
                    self.userForm.lng = pos.lng;
                    self.marker = pos;
                    self.center = pos;
                    if (self.zoomChanged) {
                        return;
                    }
                    self.zoom = 7;
                });
            }, 500),

            onMarkerMoved: _.debounce(function (e) {
                console.log('On Marker Moved', e);
                const pos = {
                    lat: e.latLng.lat(),
                    lng: e.latLng.lng(),
                };
                this.userForm.lat = pos.lat;
                this.userForm.lng = pos.lng;
                this.marker = pos;
                this.center = pos;
            }, 500),
        }
    }
</script>