<template>
    <div class="info-window">
        <tabs>
            <tab :key="face.id" v-for="(face, i) in billboard.billboard_faces" :name="face.label" :selected="i == 0">
                <h3>{{face.code}}</h3>
                <div class="row">
                    <div class="col-xs-4 no-padding">
                        <img class="img-responsive" :src="face.photo_url" alt="label"/>
                    </div>
                    <div class="col-xs-7">

                    </div>
                    <div>
                        <button class="btn btn-primary" @click="add(face)">Add</button>
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

    import * as Slc from "../../../vue/http";
    import store from './store';

    export default {
        props: {},

        store,

        data() {
            return {
                form: new SlcForm({}),
            }
        },

        computed: {
            user() {
                return this.$store.state.user;
            },
            billboard() {
                return this.$store.state.billboard;
            },
            billboards() {
                return this.$store.state.billboards;
            },
            markers() {
                return this.$store.state.markers;
            }
        },

        created() {

        },

        methods: {
            add(billboardFace) {
               this.$emit('add', billboardFace);
            },
        }
    }
</script>