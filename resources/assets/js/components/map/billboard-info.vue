<template>
    <div class="info-window">
        <tabs>
            <tab :key="face.id" v-for="(face, i) in billboard.billboard_faces" :tab-id="face.code" :name="face.label"
                 :selected="i == 0">
                <div style="padding: 0 15px;">
                    <div class="row" style="height: 82px;">
                        <div class="col-xs-12">
                            <strong style="position: relative; top: 4px;">{{face.code}}</strong>
                            <img alt="image" class="pull-right hand" style="max-width: 128px" :src="face.photo_url"
                                 v-image-preview>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="list-group clear-list">
                                <li class="list-group-item fist-item">
                                    <strong>Address</strong>
                                    <br/><br/>
                                    <span class="p-h-xs">{{billboard.address}}</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="pull-right">{{face.type}}</span>
                                    <strong>Type</strong>
                                </li>
                                <li class="list-group-item">
                                    <span class="pull-right">{{face.reads}}</span>
                                    <strong>Reads</strong>
                                </li>
                                <li v-if="face.width && face.height" class="list-group-item">
                                    <span class="pull-right">{{face.width}} x {{face.height}}</span>
                                    <strong>Dimension</strong>
                                </li>
                                <li class="list-group-item">
                                    <span class="pull-right">{{face.rate_card | money('$')}}</span>
                                    <strong>Rate Card</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </tab>
        </tabs>
    </div>
</template>

<style lang="scss">
    .info-window {
        min-width: 600px;
        min-height: 320px;
        padding: 25px;

        .panel-body {
            min-height: 270px;
        }

        .description {
            text-align: justify;
        }
        .img-responsive {
            max-width: 100%;
        }
        .dl-horizontal {
            dt {
                width: 80px;
            }
            dd {
                margin-left: 92px;
            }
        }
    }
</style>

<script>

    import * as Slc from "../../vue/http";

    export default {

        props: {
            billboard: {required: true},
            user: {required: true}
        },

        data() {
            return {
                nameteam: {}
            }
        },

        created() {
            console.log("Billboard Info", this.billboard);
        },

        methods: {
            edit(billboard) {
                window.location = laroute.route("billboards.edit", {billboard: billboard.id});
            },
        }

    }
</script>