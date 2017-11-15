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
                </div>
            </tab>
            <tab :key="face.id" v-for="face in billboard.billboard_faces" :name="face.code">
                <h3>{{face.label}}</h3>
                <div class="row">
                    <div class="col-xs-4 no-padding">
                        <img class="img-responsive" :src="face.photo_url" alt="label"/>
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
                    <div>
                        <button class="btn btn-primary" @click="addToProposal(face)">Add</button>
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

                face: null,
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
            console.log('Billboard-show',);

        },

        methods: {

            addToProposal(billboardFace) {
                this.buildForm(billboardFace);
                this.$store.commit('addBillboardFace',this.face);
            },


            buildForm(billboardFace) {

                const self = this;

                const data = {

                    billboard_id: billboardFace.billboard_id,
                    code: billboardFace.code,
                    id: billboardFace.id,
                    pivot: {
                        billboard_face_id: billboardFace.id,
                        order: (self.$store.state.proposal.billboard_faces.length + 1),
                        price: "2.00",
                        proposal_id:this.$store.state.proposal.id,
                    },

                };

                self.face = new SlcForm (data);

            }
        }
    }
</script>