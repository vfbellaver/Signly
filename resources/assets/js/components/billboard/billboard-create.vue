<template>
    <box>
        <box-title>
            {{ title }}
        </box-title>
        <box-content>
            <form-submit v-model="form" @submit="save">
                    <row>
                        <column size="6">
                            <form-group :form="form" field="name">
                                <input-label for="name">Name: </input-label>
                                <input-text v-model="form.name" id="name" name="name"></input-text>
                            </form-group>
                            <form-group :form="form" field="description">
                                <input-label for="description">Description: </input-label>
                                <text-area v-model="form.description" id="description" name="description"></text-area>
                            </form-group>
                            <form-group :form="form" field="address">
                                <input-label for="address">Address: </input-label>
                                <input-text v-model="form.address" id="address" name="address"></input-text>
                            </form-group>
                            <row>
                                <column size="6">
                                    <form-group :form="form" field="lat">
                                        <input-label for="lat">Latitude: </input-label>
                                        <input-text v-model="form.lat" id="lat" name="lat"></input-text>
                                    </form-group>
                                </column>
                                <column size="6">
                                    <form-group :form="form" field="lng">
                                        <input-label for="lng">Longitude: </input-label>
                                        <input-text v-model="form.lng" id="lng" name="lng"></input-text>
                                    </form-group>
                                </column>
                            </row>
                            <form-group :form="form" field="digital_driveby">
                                <input-label for="digital_driveby">Digital Driveby: </input-label>
                                <input-text v-model="form.digital_driveby" id="digital_driveby"
                                            name="digital_driveby"></input-text>
                            </form-group>
                        </column>
                        <column size="6">

                            <gmap-map
                                      :center="center"
                                      :zoom="zoom"
                                      @click="onMapClick"
                                      @zoom_changed="onZoomChanged"
                                      :options="mapOptions"
                                      style="width: 98%; min-height: 367px">
                                <gmap-marker
                                        v-if="marker"
                                        :position="marker"
                                        :clickable="true"
                                        :draggable="true"
                                        @dragend="onMarkerMoved"
                                        @click="center=marker"
                                ></gmap-marker>
                            </gmap-map>
                        </column>
                    </row>

                    <btn-submit :disabled="form.busy">
                        <spinner v-if="form.busy"></spinner>
                    </btn-submit>
            </form-submit>
        </box-content>
    </box>
</template>

<script>

    import * as Slc from "../../vue/http";
    import ModalForm from '../shared/Mixins/ModalForm';

    export default {

        mixins: [ModalForm],

        data() {
            return {
                api: 'billboard',
                marker: null,
                zoom: 20,
                center: {lat: 39.3209801, lng: -111.09373110000001},
                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },
                zoomChanged: false,
                gestureHandling: 'greedy'
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

        methods: {

            save(){
                const uri = laroute.route('api.billboard.store');
                Slc.post(uri, this.form).then((response) => {
                    console.log('Billboard Create:',response);
                    debugger;
                    this.$emit('saved');
                    window.location = laroute.route("billboards.edit", {billboard: response.data.id});
                });
             },

            buildForm(billboard) {
                this.marker = null;
                this.address = null;
                this.zoom = 10;
                this.center = {lat: 40.76382, lng: -111.90380399999998};
                this.zoomChanged = false;
                this.zoom = 10;
                this.center = {lat: 40.76182096906601, lng: -111.91085815429688};
                this.gestureHandling = 'greedy';

                return new SlcForm({
                    id: billboard ? billboard.id : null,
                    name: billboard ? billboard.name : null,
                    description: billboard ? billboard.description : null,
                    digital_driveby: billboard ? billboard.digital_driveby : null,
                    address: billboard ? billboard.address : null,
                    lat: billboard ? billboard.lat : null,
                    lng: billboard ? billboard.lng : null,
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
        }
    }
</script>
