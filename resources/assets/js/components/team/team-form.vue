<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Company Logo</h5>
            </div>
            <div class="ibox-content">
                <form-submit v-model="formLogo" @submit="saveTeamLogo" class="wizard-big wizard clearfix">
                    <row>
                        <div class="col-lg-4 col-sm-4 col-xs-12">
                            <form-group width="256px" :form="formLogo" field="logo">
                                <image-upload v-model="formLogo.logo" id="logo"
                                              name="logo"></image-upload>
                            </form-group>
                        </div>
                    </row>
                    <row>
                        <div class="col-xs-12">
                            <hr>
                            <button type="submit" class="btn btn-primary" :disabled="formLogo.busy">
                                <spinner v-if="formLogo.busy"></spinner>
                                Update Your Logo
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
                <form-submit v-model="form" @submit="saveTeamName" class="wizard-big wizard clearfix">
                    <row>
                        <div class="col-lg-12">
                            <form-group :form="form" field="name">
                                <input-label for="name">Name: </input-label>
                                <input-text v-model="form.name" id="name"
                                            name="name"></input-text>
                            </form-group>
                            <form-group :form="form" field="email">
                                <input-label for="email">Email: </input-label>
                                <input-text v-model="form.email" id="email"
                                            name="email"></input-text>
                            </form-group>
                            <row>
                                <column size="4">
                                    <form-group :form="form" field="phone1">
                                        <input-label for="phone1">Phone 1: </input-label>
                                        <input-text v-model="form.phone1" id="phone1"
                                                    name="phone1" v-tel></input-text>
                                    </form-group>
                                </column>
                                <column size="4">
                                    <form-group :form="form" field="phone2">
                                        <input-label for="phone2">Phone 2: </input-label>
                                        <input-text v-model="form.phone2" id="phone2"
                                                    name="phone2" v-tel></input-text>
                                    </form-group>
                                </column>
                                <column size="4">
                                    <form-group :form="form" field="fax">
                                        <input-label for="fax">Fax: </input-label>
                                        <input-text v-model="form.fax" id="fax"
                                                    name="fax" placeholder="(Optional)" v-tel></input-text>
                                    </form-group>
                                </column>
                            </row>
                            <form-group :form="form" field="address_line1">
                                <input-label for="address_line1">Address Line 1: </input-label>
                                <input-text v-model="form.address_line1" id="address_line1"
                                            name="address_line1"></input-text>
                            </form-group>

                            <form-group :form="form" field="address_line2">
                                <input-label for="address_line2">Address Line 2: </input-label>
                                <input-text v-model="form.address_line2" id="address_line2" name="address_line2"
                                            placeholder="(Optional)"></input-text>
                            </form-group>

                            <form-group :form="form" field="city">
                                <input-label for="city">City: </input-label>
                                <input-text v-model="form.city" id="city" name="city"></input-text>
                            </form-group>

                            <form-group :form="form" field="state">
                                <input-label for="state">State: </input-label>
                                <input-text v-model="form.state" id="state" name="state"></input-text>
                            </form-group>

                            <form-group :form="form" field="zipcode">
                                <input-label for="zipcode">Zipcode: </input-label>
                                <input-text v-model="form.zipcode" id="zipcode" name="zipcode"
                                            v-zipcode></input-text>
                            </form-group>
                            <hr>
                            <div>
                                <button type="submit" class="btn btn-primary" :disabled="form.busy">
                                    <spinner v-if="form.busy"></spinner>
                                    Update Company Settings
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
                form: {},
                formLogo: {}
            }
        },

        created() {
            this.form = new SlcForm({
                id: this.team.id,
                name: this.team.name,
                email: this.team.email,
                phone1: this.team.phone1,
                phone2: this.team.phone2,
                fax: this.team.fax,
                address_line1: this.team.address_line1,
                address_line2: this.team.address_line2,
                city: this.team.city,
                zipcode: this.team.zipcode,
                state: this.team.state,
                logo: this.team.logo ? this.team.logo : null,
            });

            this.formLogo = new SlcForm({
                id: this.team.id,
                logo: this.team.logo ? this.team.logo : null,
            });
        },

        methods: {

            saveTeamName() {
                const self = this;
                const uri = laroute.route('api.team.update.name', {team: this.team.id});
                SLC.put(uri, self.form).then((response) => {
                    console.log('Team updated ', response);
                });
            },

            saveTeamLogo() {
                const self = this;
                const uri = laroute.route('api.team.update.logo', {team: this.team.id});
                SLC.put(uri, self.formLogo).then((response) => {
                    console.log('Team updated ', response);
                });
            },
        }
    }
</script>