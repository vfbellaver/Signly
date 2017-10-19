<template>
    <div>
        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <box>
                    <box-content>
                        <h1 class=" text-center font-bold m-b-xs">
                            Billboard Information
                        </h1>
                        <hr/>
                        <row>
                            <column size="4">
                                <h2 class="font-bold m-b-xs">
                                    Team
                                </h2>
                                <hr>
                                <div class="contact-box">
                                        <div class="col-sm-6">
                                            <div class="text-center">
                                                <img alt="image" class="img-circle m-t-xs img-responsive" src="">
                                                <div class="m-t-xs font-bold">Graphics designer</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h3><strong>John Smith</strong></h3>
                                            <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                                            <address>
                                                <strong>Twitter, Inc.</strong><br>
                                                795 Folsom Ave, Suite 600<br>
                                                San Francisco, CA 94107<br>
                                                <abbr title="Phone">P:</abbr> (123) 456-7890
                                            </address>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            </column>
                            <column size="8">


                                    <h2 class="font-bold m-b-xs">
                                        {{billboard.name}}
                                    </h2>
                                    <hr>

                                    <h3>Billboard description</h3>

                                    <div class="text-muted">
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at its layout. The point of using Lorem Ipsum is
                                        There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form, by injected humour, or randomised words
                                        which don't look even slightly believable.
                                    </div>
                                    <dl class="m-t-md">
                                        <dt>Description lists</dt>
                                        <dd>A description list is perfect for defining terms.</dd>
                                        <dt>Euismod</dt>
                                    </dl>

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
                    console.log("Billboard Public", response);
                    this.billboard = response[0];
                    this.center = response[0].position;
                    this.marker = response[0].position;
                    this.pov = response[0].pov;
                    this.loaded = true;
                });
            },

            reloadForm() {
                //this.form.he this.pov.heading;
            },


            onMapClick(e) {

                const self = this;

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