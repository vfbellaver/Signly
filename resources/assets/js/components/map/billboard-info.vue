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
                        <div class="col-md-6">
                            <btn-submit class="btn-info"
                                    @click.native="showDetails(billboard)"
                            >
                                SHOW DETAILS
                            </btn-submit>
                        </div>
                        <div class="col-md-6" v-if="this.user.email">
                            <btn-submit
                                    @click.native="edit(billboard)"
                            >
                                EDIT
                            </btn-submit>
                        </div>
                </div>
            </tab>
            <tab :key="face.id" v-for="face in billboard.billboard_faces" :name="face.code">
                <h3>{{face.label}}</h3>
                <div class="row">
                    <div class="col-xs-4 no-padding">
                        <img class="img-responsive" :src="face.photo" alt="label"/>
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
                            <dd>{{face.hard_cost}}</dd>
                        </dl>
                    </div>
                </div>
            </tab>
        </tabs>
    </div>
</template>

<style lang="scss" scoped="true">
    .info-window {
        min-width: 600px;
        min-height: 256px;
        padding: 25px;
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

        created() {
            console.log("Billboard Info", this.billboard);
        },

        methods: {

            edit(billboard) {
                window.location = laroute.route("billboards.edit", {billboard: billboard.id});
            },

            showDetails(billboard){

                console.log('equipe - ',billboard.team.id);
                 Slc.get(laroute.route("billboard.team", {id: billboard.team.id}))
                    .then((response) => {
                       console.log('Team billboard',response);
                    });

                window.location = laroute.route('billboard.details',
                        {teamName: team.name, billboardnaName: billboard.name, id:billboard.id});

            }
        }

    }
</script>