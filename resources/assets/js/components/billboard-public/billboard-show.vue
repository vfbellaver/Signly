<template>
    <box>
        <box-title></box-title>
        <box-body>
            <column size="12">
                <row>
                    <column size="7">
                            <img class="imgface" :src="billboardFaces[0].photo"/>
                    </column>

                    <column class="img" size="5">
                        <gmap-map
                                class="map"
                                :center="center"
                                :zoom="zoom"
                                :options="mapOptions"
                                style="width: 100%; min-height: 320px">
                            <gmap-marker
                                    v-if="marker"
                                    :position="marker"
                                    :clickable="false"
                                    :draggable="true"
                            ></gmap-marker>
                        </gmap-map>
                        <div class="billboard-info">
                            <div class="card-body">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </column>
                </row>
            </column>
            <!-- navbar faces -->
            <column size="12">
                <faces-billboard :billboardId="id"></faces-billboard>
            </column>
        </box-body>
    </box>
</template>
<style lang="scss" scoped="scoped">
     .imgface {
        max-width: 100%;
     }

    .billboard-info {
        margin-top: 10px;
        border: 2px solid #00A5E3;
    }


</style>
<script>
    import FacesBillboard from './faces-billboard.vue'
    export default {
        props: {
            id: {required: true}
        },

        components: {
            FacesBillboard,
        },

        data(){
            return {
                loaded: false,
                marker: null,
                zoom: 15,
                center: null,
                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },
                zoomChanged: false,
                billboardFaces: [],
                billboard: {},
            }
        },
        mounted(){
            this.loadBillboard();
            this.loadFaces();
        },

        methods: {
            loadBillboard() {
                this.loaded = false;

                const uri = laroute.route('api.billboard.show', {billboard: this.id});
                Slc.find(uri).then((billboard) => {
                    console.log("Billboard loaded", billboard);
                    this.billboard = billboard;
                    const lat = Number.parseFloat(billboard.lat);
                    const lng = Number.parseFloat(billboard.lng);

                    this.center = {lat: lat, lng: lng};
                    this.marker = {lat: lat, lng: lng};

                    this.loaded = true;
                });
            },
            loadFaces() {
                let self = this;
                Slc.get(laroute.route('api.billboard-face.index', {bid: this.id}))
                    .then((response) => {
                        self.billboardFaces = response;
                    });
            },
            onMapClick(){ return false},
            onZoomChanged(){ return false},
            onMarkerMoved(){ return false},
        }
    }
</script>
