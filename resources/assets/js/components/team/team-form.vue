<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Company Logo</h5>
            </div>
            <div class="ibox-content">
                <form-submit v-model="team" @submit="saveTeamLogo" class="wizard-big wizard clearfix">
                    <row>
                        <div class="col-lg-4 col-sm-4 col-xs-12">
                            <form-group width="256px" :form="team" field="logo">
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
                </form-submit>
            </div>
        </div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Company Settings</h5>
            </div>
            <div class="ibox-content">
                <form-submit v-model="team" @submit="saveTeamName" class="wizard-big wizard clearfix">
                    <row>
                        <div class="col-lg-12">
                            <form-group :form="team" field="name">
                                <input-label for="name">Name: </input-label>
                                <input-text v-model="team.name" id="name"
                                            name="name"></input-text>
                            </form-group>
                            <form-group :form="team" field="email">
                                <input-label for="email">Email: </input-label>
                                <input-text v-model="team.email" id="email"
                                            name="email"></input-text>
                            </form-group>
                            <form-group :form="team" field="address">
                                <input-label for="address">Address: </input-label>
                                <input-text v-model="team.address" id="address"
                                            name="address"></input-text>
                            </form-group>
                            <row>
                                <column size="6">
                                    <form-group :form="team" field="phone">
                                        <input-label for="phone">Phone: </input-label>
                                        <input-text v-model="team.phone" id="phone"
                                                    name="phone" v-tel></input-text>
                                    </form-group>
                                </column>
                                <column size="6">
                                    <form-group :form="team" field="fax">
                                        <input-label for="fax">Fax: </input-label>
                                        <input-text v-model="team.fax" id="fax"
                                                    name="fax" placeholder="(Optional)" v-tel></input-text>
                                    </form-group>
                                </column>
                            </row>

                            <hr>
                            <div>
                                <button type="submit" class="btn btn-primary">Update Company Settings
                                </button>
                            </div>
                        </div>
                    </row>
                </form-submit>
                <div class="clear"></div>
            </div>
        </div>
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

            saveTeamName(){
                const self = this;
                const uri = laroute.route('api.team.update.name', {team: this.team.id});
                SLC.put(uri, self.team).then((response) => {
                    console.log('Team updated ', response);
                });
            },

            saveTeamLogo(){
                const self = this;
                const uri = laroute.route('api.team.update.logo', {team: this.team.id});
                SLC.put(uri, self.team).then((response) => {
                    console.log('Team updated ', response);
                });
            },

            buildForm(){
                this.team = new SlcForm({
                    id: this.team.id,
                    name: this.team.name,
                    email: this.team.email,
                    phone: this.team.phone,
                    address: this.team.address,
                    fax: this.team.fax,
                    logo: this.team.logo ? this.team.logo : null,
                });
            },
        }
    }
</script>