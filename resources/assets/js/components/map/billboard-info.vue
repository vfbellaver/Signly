<template>
    <div class="info-window">
        <tabs>
            <tab name="Billboard" :selected="true">
                <div>
                    <h3>{{billboard.name}}</h3>
                    <p class="description">{{billboard.description}}</p>
                    <h4>Address</h4>
                    <div>{{billboard.address}}</div>
                    <h4>Location</h4>
                    <div>{{billboard.lat}}, {{billboard.lng}}</div>
                    <hr/>
                    <div class="col-md-6" v-if="this.user.email">
                        <btn-submit @click.native="edit(billboard)">Edit</btn-submit>
                    </div>
                </div>
            </tab>
            <tab :key="face.id" v-for="face in billboard.billboard_faces" :name="face.code">
                <h3>{{face.label}}</h3>
                <div class="row">
                    <div class="col-xs-4 no-padding">
                        <img class="img-responsive" :src="face.photo_url" alt="label" @click="showImage(face.photo_url)"/>
                    </div>
                    <div class="col-xs-7">
                        <dl class="dl-horizontal">
                            <dt>Type:</dt>
                            <dd>Static</dd>
                            <dt>Reads:</dt>
                            <dd>{{face.reads}}</dd>
                            <dt>Dimensions:</dt>
                            <dd>{{face.width}} x {{face.height}}</dd>
                            <dt>DEC:</dt>
                            <dd>{{face.reads}}</dd>
                            <dt>Rate Card:</dt>
                            <dd>{{face.rate_card}}</dd>
                        </dl>
                    </div>
                </div>
            </tab>
        </tabs>

        <photo-face :src="photo_url" ref="photoFace"></photo-face>
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
            cursor: pointer;
            transition: 0.3s;
        }
        .img-responsive:hover{
            opacity: 0.7;
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
    import PhotoFace from './photo-face';

    export default {
        components: {
          PhotoFace,
        },

        props: {
            billboard: {required: true},
            user: {required: true}
        },

        data() {
            return {
                nameteam: {},
                photo_url:'',
            }
        },

        created() {
            console.log("Billboard Info", this.billboard);
        },

        methods: {

            edit(billboard) {
                window.location = laroute.route("billboards.edit", {billboard: billboard.id});
            },

            showImage(photo){
                this.photo_url = photo;
                this.$refs.photoFace.show();
            },
        }

    }
</script>