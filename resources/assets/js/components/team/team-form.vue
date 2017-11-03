<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Team Settings</h5>
            </div>
            <div class="ibox-content">
                <form-submit v-model="team" @submit="saveTeam" class="wizard-big wizard clearfix">
                    <div class="content clearfix">
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-8">
                                    <form-group :form="team" field="name">
                                        <input-label for="name">Name: </input-label>
                                        <input-text v-model="team.name" id="name"
                                                    name="name"></input-text>
                                    </form-group>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Update Profile
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="text-center">
                                        <form-group :form="team" field="logo">
                                            <image-upload v-model="team.logo" id="logo"
                                                          name="logo"></image-upload>
                                        </form-group>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form-submit>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped="scoped">

    hr {
        border-bottom: solid 4px #43A3D0;
    }

    .ibox {
        clear: none;
        margin-bottom: 60px;
        margin-top: 0px;
        padding: 0;
    }

    .ibox-content {
        clear: none;
    }
</style>
<script>

    import * as SLC from '../../vue/http'

    export default {
        data() {
            return {
                team: Slc.user.team,
            }
        },

        created(){
            this.buildForm();
        },

        methods: {
            saveTeam(){
                const self = this;
                const uri = laroute.route('api.team.update', {team: this.team.id});
                SLC.put(uri, self.team).then((response) => {
                    console.log('Team updated ', response);
                });
            },

            buildForm(){
                this.team = new SlcForm({
                    id: this.team.id,
                    logo: this.team.logo ? this.team.logo : null,
                    name: this.team.name,
                });
            },
        }
    }
</script>