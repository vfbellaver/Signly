<template>
    <div>
        <form-submit v-model="team" @submit="saveTeam" class="wizard-big wizard clearfix">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Your Logo</h5>
                </div>
                <div class="ibox-content">
                    <row>
                        <div class="col-lg-4 col-sm-4 col-xs-12">
                            <form-group :form="team" field="logo">
                                <image-upload v-model="team.logo" id="logo"
                                              name="logo"></image-upload>
                            </form-group>
                        </div>
                    </row>
                    <row>
                        <div class="col-xs-12">
                            <hr>
                            <button type="submit" class="btn btn-primary">Update Your Logo
                            </button>
                        </div>
                        <div class="clear"></div>
                    </row>
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Team Settings</h5>
                </div>
                <div class="ibox-content">
                    <row>
                        <div class="col-lg-12">
                            <form-group :form="team" field="name">
                                <input-label for="name">Name: </input-label>
                                <input-text v-model="team.name" id="name"
                                            name="name"></input-text>
                            </form-group>
                            <hr>
                            <div>
                                <button type="submit" class="btn btn-primary">Update Your Name
                                </button>
                            </div>
                        </div>
                    </row>
                    <div class="clear"></div>
                </div>
            </div>
        </form-submit>
    </div>
</template>
<style lang="scss" scoped="scoped">

    .ibox {
        clear: none;
        margin-bottom: 60px;
        margin-top: 0px;
        padding: 0;
    }

    hr {
        margin-top: 1px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #eeeeee;
    }

    .row:before, .row:after {
        content: " ";
        display: none;
    }

    .ibox-content {
        clear: none;
    }

    .clear {
        clear: both;
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