<template>
    <div class="info-window">
        <div class="window-title">
            <h2>{{billboard.name}}</h2>
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