<template>

    <gmap-map
            :options="mapOptions"
            :center="center"
            :zoom="11"
            style="width: 100%; height: 580px;"

    >

        <gmap-info-window
                :options="infoOptions"
                :position="infoWindowPos"
                :opened="infoWinOpen"
                @closeclick="infoWinOpen=false">

            <info-content

                    :billboard="billboard"
            >
            </info-content>

        </gmap-info-window>


        <gmap-marker :key="i" v-for="(m,i) in markers" :position="m.position" :clickable="true" @click="toggleInfoWindow(m,i)"></gmap-marker>

    </gmap-map>

</template>

<script>

    export default {

        data () {
            return {

                billboards: [],

                center: {lat: 40.7765867, lng: -111.9906962},

                markers: [],

                billboard:'',

                mapOptions: {
                    mapTypeControl: false,
                    scrollWell: true,
                    gestureHandling: 'greedy'
                },

                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -35,
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

                //check if its the same marker that was selected if yes toggle
                if (this.currentMidx == idx) {
                    this.infoWinOpen = !this.infoWinOpen;
                }
                //if different marker set infowindow to open and reset current marker index
                else {
                    this.infoWinOpen = true;
                    this.currentMidx = idx;
                }
            }

        }
    }
</script>