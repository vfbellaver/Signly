<template>
    <div class="info-window">
        <tabs>
            <tab :key="face.id" v-for="(face, i) in billboard.billboard_faces" :name="face.label" :selected="i == 0">
                <div style="padding: 0 15px;">
                    <div class="row">
                        <div class="col-xs-12">
                            <strong style="position: relative; top: 4px;">{{face.code}}</strong>
                            <img alt="image" class="pull-right" style="max-width: 128px" :src="face.photo_url">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row" style="height: 82px;">
                        <div class="col-xs-12">
                            <ul class="list-group clear-list">
                                <li class="list-group-item fist-item">
                                    <span class="pull-right">{{billboard.address}}</span>
                                    Address
                                </li>
                                <li class="list-group-item">
                                    <span class="pull-right">{{face.type}}</span>
                                    Type
                                </li>
                                <li class="list-group-item">
                                    <span class="pull-right">{{face.reads}}</span>
                                    Reads
                                </li>
                                <li v-if="face.width && face.height" class="list-group-item">
                                    <span class="pull-right">{{face.width}} x {{face.height}}</span>
                                    Dimension
                                </li>
                                <li class="list-group-item">
                                    <span class="pull-right">{{face.rate_card | money('$')}}</span>
                                    Rate Card
                                </li>
                            </ul>

                            <button class="btn btn-primary btn-sm" @click="add(face)" :disabled="disabled(face)">
                                Add to Proposal
                            </button>
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
            proposal() {
                return this.$store.state.proposal;
            },
            billboards() {
                return this.$store.state.billboards;
            },
            markers() {
                return this.$store.state.markers;
            },
        },

        created() {

        },

        methods: {
            add(face) {
                this.$emit('add', face);
            },
            disabled(face) {
                const faces = this.proposal.billboard_faces;
                for (let i = 0; i < faces.length; i++) {
                    const f = faces[i];
                    if (f.id === face.id) {
                        return true;
                    }
                }
                return false;
            }
        }
    }
</script>