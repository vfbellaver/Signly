<template>
    <box>
        <box-title>
            Billboard Information
        </box-title>
        <box-body>
            <column size="12">
                <row>
                    <column size="7">
                        <div class="card-body">
                            <img :src="billboardFaces[0].photo"/>
                        </div>
                    </column>

                    <column class="img" size="5">
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
                       <h1>BILLBOARD INFORMATION</h1>
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
                billboardFaces: [],
            }
        },
        mounted(){
            this.load();
        },

        methods: {
            load() {
                let self = this;
                Slc.get(laroute.route('api.billboard-face.index', {bid: this.id}))
                    .then((response) => {
                        self.billboardFaces = response;
                    });
            },
        }
    }
</script>
