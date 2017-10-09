<template>
    <gmap-map
            :center="center"
            :zoom="10"
            style="width: 100%; height: 90vmin;"

    >
            <gmap-info-window
                    :options="infoOptions"
                    :position="infoWindowPos"
                    :opened="infoWinOpen"
                    @closeclick="infoWinOpen=false">
                <info-content-two

                        :billboard-faces="billboardFaces"
                >
                </info-content-two>
            </gmap-info-window>
        <gmap-marker
                :key="i"
                v-for="(m,i) in markers"
                :position="m.position"
                :clickable="true"
                @click="toggleInfoWindow(m,i)">
        </gmap-marker>
    </gmap-map>
</template>

<script>
    export default {

        data () {
            return {

                billboards: [],
                billboardFaces: [],

                infoShow: false,

                center: {lat: 40.757994, lng: -111.970834},

                markers: [],

                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -35,
                        maxWidth: 200
                    }
                },


                infoWinOpen: false,

                infoWindowPos: {
                    lat: 0,
                    lng: 0
                },

                billboard:'',

            }
        },

        mounted () {
            this.reload();
        },

        methods: {

            reload() {
                Slc.get(laroute.route('api.billboard.index'))
                    .then((response) => {
                        this.billboards = response;
                        this.reloadMarkers();
                    });

            },

            reloadMarkers () {
                const self = this;
                for(let i = 0; i < this.billboards.length; i++) {
                  this.markers.push({
                        position: {
                            lat: parseFloat(this.billboards[i].lat),
                            lng: parseFloat(this.billboards[i].lng)
                        },

                        infoText: this.billboards[i],
                   });
                }

            },

            toggleInfoWindow: function(marker, idx) {

                this.infoWindowPos = marker.position;
                this.billboard = marker.infoText;
                console.log('Billboard Id ',this.billboard.id);
                this.loadFaces(this.billboard.id);


                //check if its the same marker that was selected if yes toggle
                if (this.currentMidx == idx) {
                    this.infoWinOpen = !this.infoWinOpen;
                }
                //if different marker set infowindow to open and reset current marker index
                else {
                    this.infoWinOpen = true;
                    this.currentMidx = idx;
                }
            },

            loadFaces(billboardId) {
                Slc.get(laroute.route('api.billboard-face.index', {bid: billboardId}))
                    .then((response) => {
                        console.log('Response ', response);
                        this.billboardFaces = response;
                    });
            },

        }
    }
</script>