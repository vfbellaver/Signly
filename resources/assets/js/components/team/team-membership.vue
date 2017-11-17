<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Invite a new member to Team</h5>
            </div>
            <div class="ibox-body">
                <form-submit v-model="userEmail" @submit="sendEmail">
                    <div class="row">
                        <div class="col-xs-12">
                            <form-group :form="userEmail" field="email">
                                <input-label for="email">Email: </input-label>
                                <input-text v-model="userEmail.email" id="email"
                                            name="email"></input-text>
                            </form-group>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <hr>
                            <btn-submit class="btn btn-primary" :disabled="userEmail.busy">
                                <spinner v-if="userEmail.busy"></spinner>
                                <span>Send</span>
                            </btn-submit>
                        </div>
                    </div>
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

    .ibox-body {
        background-color: white;
        height: 166px;
        margin-top: 2px;
        padding: 10px 20px 20px 20px;
    }

    .clear {
        clear: both;
    }
</style>
<script>

    import * as Slc from '../../vue/http'

    export default {
        data() {
            return {
                userEmail: '',
            }
        },

        created(){
            this.userEmail = new SlcForm({
                email: '',
            });
        },

        methods: {
            sendEmail(){
                const uri = laroute.route('api.team.invite.member');
                Slc.post(uri, this.userEmail).then((response) => {
                    this.loadUser();
                    this.$emit('newEmail');
                });
            },

            loadUser(){
                this.userEmail = new SlcForm({
                    email: '',
                });
            },

        }
    }
</script>