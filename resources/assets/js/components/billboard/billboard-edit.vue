<template>
    <div>
        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>

        <nav class="navbar navbar-in-content navbar-default" data-spy="affix" data-offset-top="147">
            <ul class="nav navbar-nav navbar-right">
                <li><a @click="addBillboardFace">
                    <icon icon="plus"></icon>
                    Add Face</a></li>
            </ul>
        </nav>

        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Location</h5>
                        </div>
                        <div class="ibox-content">
                            <form-submit v-model="form" @submit="save">
                                <form-group :form="form" field="name">
                                    <input-label for="name">Name: </input-label>
                                    <input-text v-model="form.name" id="name" name="name"></input-text>
                                </form-group>
                                <form-group :form="form" field="address">
                                    <input-label for="address">Address: </input-label>
                                    <input-text v-model="form.address" id="address" name="address"></input-text>
                                </form-group>
                                <div class="map-container">
                                    <gmap-map
                                            v-if="loaded"
                                            :center="center"
                                            :zoom="zoom"
                                            @click="onMapClick"
                                            @zoom_changed="onZoomChanged"
                                            :options="mapOptions">
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

                                    <gmap-street-view-panorama
                                            v-if="streetViewLoaded"
                                            class="pano"
                                            :position="center"
                                            :pov="pov"
                                            :zoom="1"
                                            @pano_changed="updatePano"
                                            @pov_changed="updatePov">
                                    </gmap-street-view-panorama>
                                </div>
                                <hr/>
                                <form-group :form="form" field="lat">
                                    <input-label for="lat">Latitude: </input-label>
                                    <input-text v-model="form.lat" id="lat" name="lat"></input-text>
                                </form-group>

                                <form-group :form="form" field="lng">
                                    <input-label for="lng">Longitude: </input-label>
                                    <input-text v-model="form.lng" id="lng" name="lng"></input-text>
                                </form-group>

                                <hr>
                                <btn-submit :disabled="form.busy">
                                    <spinner v-if="form.busy"></spinner>
                                </btn-submit>
                                <a class="btn btn-default" :href="billboardListRoute">Cancel</a>
                            </form-submit>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Faces</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 64px">ID</th>
                                        <th>Facing</th>
                                        <th style="width: 120px">Type</th>
                                        <th style="width: 92px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="face in faces">
                                        <td>{{face.code}}</td>
                                        <td>{{face.label}}</td>
                                        <td>{{face.type}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-xs"><i
                                                    class="fa fa-edit" @click="openBillboardFace(face)"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs"
                                                    @click="billboardDestroy(face)"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <billboard-face-form ref="billboardFaceForm" :billboardId="id"
                             @created="billboardFaceCreated"
                             @updated="billboardFaceUpdated"></billboard-face-form>
    </div>
</template>

<style lang="scss" scoped="scoped">
    .top-navigation .wrapper.wrapper-content {
        padding-top: 0;
    }

    .margin-billboard-edit {
        margin-right: 5px;
    }

    .map-container {
        position: relative;

        .vue-map-container {
            width: 100%;
            min-height: 600px
        }

        .vue-street-view-pano-container {
            position: absolute;
            width: 320px;
            height: 260px;
            bottom: 0;
            left: 0;
        }
    }

</style>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";
    import BillboardFaceForm from './edit/billboard-face-form';

    export default {
        props: {
            id: {required: true},
        },
        components: {
            BillboardFaceForm
        },

        data() {
            return {
                form: new SlcForm({}),
                faces: [],
                loaded: false,
                marker: null,
                markerIcon: {
                    url: '/images/pin.png',
                    size: {width: 48, height: 48, f: 'px', b: 'px'},
                    scaledSize: {width: 48, height: 48, f: 'px', b: 'px'}
                },
                zoom: 7,
                showPOV: false,
                center: null,
                position: null,
                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },
                pov: null,
                streetViewLoaded: false,
                pano: null,
                zoomChanged: false,
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
                        pitch: billboard.pitch,
                    });
                    this.streetViewLoaded = true;
                    this.loaded = true;
                    this.faces = billboard.billboard_faces;
                });
            },

            save() {
                const uri = laroute.route('api.billboard.update', {billboard: this.form.id});
                Slc.put(uri, this.form).then((response) => {
                    console.log('Billboard Updated:', response);
                });
            },

            addBillboardFace() {
                this.$refs.billboardFaceForm.show();
            },

            openBillboardFace(face) {
                this.$refs.billboardFaceForm.show(face);
            },

            billboardFaceCreated(face) {
                this.faces.push(face);
            },

            billboardFaceUpdated(face) {
                const i = this.faces.indexOf(face);
                const f = this.faces[i];
                Object.assign(f, face);
            },

            billboardDestroy(face) {
                face.destroyForm = new SlcForm({});
                Slc.delete(laroute.route('api.billboard-face.destroy', {billboard_face: face.id}), face.destroyForm)
                    .then(() => {
                        const i = this.faces.indexOf(face);
                        this.faces.splice(i, 1);
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

                console.log('On click Billboard', this.form);
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
                    self.streetViewLoaded = false;
                    self.$nextTick(() => {
                        self.streetViewLoaded = true;
                    });
                    if (self.zoomChanged) {
                        return;
                    }
                    self.zoom = 15;
                    console.log('On address Changed Billboard', this.form);
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
                console.log('Is center chaged', this.center);
                this.streetViewLoaded = false;
                this.$nextTick(() => {
                    this.streetViewLoaded = true;
                });
                console.log('On marker Moved Billboard', this.form);
            }),

            updatePov(pov) {
                console.log('Pov Changed: ', pov);
                this.pov = pov;
                this.form.heading = pov.heading;
                this.form.pitch = pov.pitch;
                console.log('Update Pov Billboard', this.form);
            },

            updatePano(pano) {
                const self = this;
                this.pano = pano;
                console.log('Update pano', this.form);
                const sv = new google.maps.StreetViewService();
                sv.getPanoramaById(pano, data => {
                    const lat = data.location.latLng.lat();
                    const lng = data.location.latLng.lng();
                    self.form.lat = lat;
                    self.form.lng = lng;
                    self.marker.lat = lat;
                    self.marker.lng = lng;
                });
            }
        }
    }
</script>