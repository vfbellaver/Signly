<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Invite a new member to Team</h5>
            </div>
            <div class="ibox-content">
                <form-submit v-model="userEmail" @submit="sendEmail">
                    <div class="col-lg-12">
                        <form-group :form="userEmail" field="email">
                            <input-label for="email">Email: </input-label>
                            <input-text v-model="userEmail.email" id="email"
                                        name="email"></input-text>
                        </form-group>
                    </div>
                    <hr>
                    <div class="col-lg-12">
                        <btn-submit class="btn btn-primary">
                            <spinner v-if="userEmail.busy"></spinner>
                            <span><i class="fa fa-envelope"></i>  SEND</span>
                        </btn-submit>
                    </div>
                </form-submit>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
</template>
<style>
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
                    this.userEmail = '';
                    this.$emit('newEmail');
                });
            },

        }
    }
</script>