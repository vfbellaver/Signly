<template>
    <modal>
        <modal-header>{{ title }}</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="12">
                        <form-group :form="form" field="name">
                            <input-label for="name">Name: </input-label>
                            <input-text v-model="form.name" id="name" name="name"></input-text>
                        </form-group>
                        <form-group :form="form" field="address">
                            <input-label for="address">Address: </input-label>
                            <input-text v-model="form.address" id="address" name="address"></input-text>
                        </form-group>
                    </column>
                    <column size="12">
                        <gmap-map v-if="isShown"
                                  :center="center"
                                  :zoom="zoom"
                                  @click="onMapClick"
                                  @zoom_changed="onZoomChanged"
                                  :options="mapOptions"
                                  style="width: 95%; min-height: 320px">
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
                    </column>
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
            </modal-body>
            <modal-footer>
                <btn-submit :disabled="form.busy">
                    <spinner v-if="form.busy"></spinner>
                </btn-submit>
            </modal-footer>
        </form-submit>
    </modal>
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
                markerIcon: {
                    url: 'http://signly.dev/images/pin.png',
                    size: {width: 48, height: 48, f: 'px', b: 'px'},
                    scaledSize: {width: 48, height: 48, f: 'px', b: 'px'}
                },
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