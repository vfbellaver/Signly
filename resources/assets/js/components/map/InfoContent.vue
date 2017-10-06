<template>
    <div class="info-window">
        <div class="title">
            <column size="2">
                <img src="/images/pin-6-64.png" width="30px"/>
            </column>
            <column size="10">
                <h3>{{billboard.name}}</h3>
            </column>
        </div>
        <div class="window-content">
            <div class="window-subTitle">
                <h3>Description</h3>
            </div>
            <div class="window-body">
                <p>{{billboard.description}}</p>
            </div>
            <div class="window-footer">
                <p class="billboard-digital-driveby"><icon icon="world"></icon>
                    &nbsp{{billboard.digital_driveby}}
                </p>
                <p>
                    <icon icon="map-marker"></icon>
                    &nbsp{{billboard.address}}
                </p>
            </div>
        </div>
    </div>
</template>
<style>
    .info-window {
        margin: 0px;
    }
    .title {
        text-align: left;
        padding: 5px;
        height: 40px;
        background-color: gainsboro;
    }
    .circulo{
        background: #666;
        border-radius:100%;
        width:40px;
        height:40px;
    }
    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<script>

    import * as Slc from "../../vue/http";

    export default {

        props: {

            billboard: {
                required: true,
            },

        },

        data(){
          return {
              billboardFaces: []
          }
        },

        created(){
            this.reload();
        },

        methods: {
            reload() {
                let self = this;
                Slc.get(laroute.route('api.billboard-face.index', {bid: this.billboard.id}))
                    .then((response) => {
                        console.log('Response ', response);
                        self.billboardFaces = response;
                    });
            },
        }

    }
</script>