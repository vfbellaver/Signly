<template>
    <div>
        <box>
            <box-content>
                <div class="row">
                    <div class="col-md-6">
                        <box>
                            <box-title>
                                Update Photo
                            </box-title>
                            <box-content>
                                <div class="row">
                                    <div class="col-md-12">
                                        <image-upload v-model="photoUrl" id="photo" name="photo"></image-upload>
                                    </div>
                                </div>
                            </box-content>
                        </box>
                    </div>
                    <div class="col-md-6">
                        <box>
                            <box-title>
                                User Default Location
                            </box-title>
                            <box-content>
                                <form-submit v-model="addressForm" @submit="updateAddress">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form-group :form="addressForm" field="address">
                                                <input-label for="address">Address: </input-label>
                                                <input-text v-model="addressForm.address" id="address"
                                                            name="address"></input-text>
                                            </form-group>
                                            <gmap-map
                                                    v-if="addressForm"
                                                    :center="center"
                                                    :zoom="zoom"
                                                    @click="onMapClick"
                                                    @zoom_changed="onZoomChanged"
                                                    :options="mapOptions"
                                                    style="width: 100%; min-height: 320px">
                                                <gmap-marker
                                                        :position="marker"
                                                        :clickable="true"
                                                        :draggable="true"
                                                        @dragend="onMarkerMoved"
                                                        @click="center=marker"
                                                ></gmap-marker>
                                            </gmap-map>

                                            <form-group :form="addressForm" field="lat">
                                                <input-label for="lat">Latitude: </input-label>
                                                <input-text v-model="addressForm.lat" id="lat" name="lat"></input-text>
                                            </form-group>

                                            <form-group :form="addressForm" field="lng">
                                                <input-label for="lng">Longitude: </input-label>
                                                <input-text v-model="addressForm.lng" id="lng" name="lng"></input-text>
                                            </form-group>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr>
                                                <btn-submit :disabled="addressForm.busy">
                                                    <spinner v-if="addressForm.busy"></spinner>
                                                </btn-submit>
                                            </div>
                                        </div>
                                    </div>
                                </form-submit>

                            </box-content>
                        </box>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <box>
                            <box-title>
                                Update Profile
                            </box-title>
                            <box-content>
                                <form-submit v-model="profileForm" @submit="updateProfile">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form-group :form="profileForm" field="name">
                                                <input-label for="name">Name: </input-label>
                                                <input-text id="name" v-model="profileForm.name"></input-text>
                                            </form-group>
                                            <form-group :form="profileForm" field="email">
                                                <input-label for="email">Email: </input-label>
                                                <input-email id="email" v-model="profileForm.email"
                                                             name="email"></input-email>
                                            </form-group>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                            <btn-submit :disabled="profileForm.busy">
                                                <spinner v-if="profileForm.busy"></spinner>
                                            </btn-submit>
                                        </div>
                                    </div>
                                </form-submit>
                            </box-content>
                        </box>
                    </div>
                    <div class="col-md-6">
                        <box>
                            <box-title>
                                Update Password
                            </box-title>
                            <box-content>
                                <form-submit v-model="passwordForm" @submit="updatePassword">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form-group :form="passwordForm" field="password">
                                                <input-label for="password">Password: </input-label>
                                                <input-password id="password"
                                                                v-model="passwordForm.password"></input-password>
                                            </form-group>
                                            <form-group :form="passwordForm" field="password_confirm">
                                                <input-label for="password_confirm">Password Password: </input-label>
                                                <input-password id="password_confirm"
                                                                v-model="passwordForm.password_confirm"></input-password>
                                            </form-group>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                            <btn-submit :disabled="passwordForm.busy">
                                                <spinner v-if="passwordForm.busy"></spinner>
                                            </btn-submit>
                                        </div>
                                    </div>
                                </form-submit>
                            </box-content>
                        </box>
                    </div>
                </div>
            </box-content>
        </box>
    </div>
</template>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";

    export default {
        props: {
            user: {required: true},
            settings: {required: true}
        },
        components: {},
        data() {
            return {
                photoUrl: this.user.photo_url,
                passwordForm: new SlcForm({password: null, password_confirm: null}),
                profileForm: new SlcForm({name: this.user.name, email: this.user.email}),
                addressForm: null,
                zoom: 7,
                marker: null,
                center: null,
                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },
                zoomChanged: false,
            }
        },

        created() {
            const lat = Number.parseFloat(this.user.lat);
            const lng = Number.parseFloat(this.user.lng);
            this.center = {lat: lat, lng: lng};
            this.marker = {lat: lat, lng: lng};
            this.addressForm = new SlcForm({address: this.user.address, lat: lat, lng: lng});
        },

        watch: {
            photoUrl(value, oldValue) {
                if (!oldValue) {
                    return;
                }
                this.$nextTick(() => {
                    this.updatePhoto();
                });
            },
            'addressForm.address': function (value, oldValue) {
                if (!oldValue) {
                    return;
                }
                this.onAddressChange();
            },
        },
        methods: {
            updatePhoto() {
                const uri = laroute.route('api.user.update.photo', {user: this.user.id});
                Slc.put(uri, new SlcForm({photo_url: this.photoUrl})).then((response) => {
                    console.log("Photo saved", response);
                    EventBus.$emit('userUpdated');
                })
            },
            updatePassword() {
                const uri = laroute.route('api.user.update.password', {user: this.user.id});
                Slc.put(uri, this.passwordForm).then((response) => {
                    console.log("Password saved", response);
                })
            },
            updateProfile() {
                const uri = laroute.route('api.user.update', {user: this.user.id});
                Slc.put(uri, this.profileForm).then((response) => {
                    console.log("Profile saved", response);
                    EventBus.$emit('userUpdated');
                })
            },
            updateAddress() {
                const uri = laroute.route('api.user.update.address', {user: this.user.id});
                Slc.put(uri, this.addressForm).then((response) => {
                    console.log("Address saved", response);
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
                geocoder.geocode({address: self.addressForm.address}, (results, status) => {
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
                    self.addressForm.lat = pos.lat;
                    self.addressForm.lng = pos.lng;
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
                this.addressForm.lat = pos.lat;
                this.addressForm.lng = pos.lng;
                this.marker = pos;
                this.center = pos;
            }, 500),
        }
    }
</script>