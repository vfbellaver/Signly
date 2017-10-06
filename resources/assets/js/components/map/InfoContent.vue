<template>
    <div class="info-window">
        <div class="title">
            <column size="4">
                <img src="/images/pin-6-64.png" width="30px"/>
            </column>
            <column size="4">
                <h2>{{billboard.name}}</h2>
            </column>
        </div>
        <div class="window-content">
            <div class="window-subTitle">
                <h3>Description</h3>
            </div>
            <div class="window-body">
                <p>{{billboard.description}}</p>
            </div>
            <hr>
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
    .circulo{
        background: #666;
        border-radius:100%;
        width:40px;
        height:40px;
    }
    .circulo > img {
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

    }
</script>