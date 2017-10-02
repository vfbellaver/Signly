<template>
    <div class="info-window">
        <div class="window-title">
            <h2>{{billboard.name}}</h2>
        </div>
        <div class="window-content">
            <div class="window-body">
                <h3>Description</h3>
            </div>
            <hr>
            <div class="window-body">
                <p>{{billboard.description}}</p>
            </div>
            <hr>
            <div class="window-footer">
                <p>{{billboard.address}}</p>
            </div>
        </div>
    </div>
</template>

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