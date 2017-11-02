<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Invite a new member to Team</h5>
            </div>
            <div class="ibox-content">
                <form-submit v-model="userEmail" @submit="sendEmail">
                    <div class="input-group">
                        <input-text class="form-control input-lg" v-model="userEmail.email" id="email"
                                    name="email"></input-text>
                        <div class="input-group-btn">
                            <btn-submit class="btn btn-lg btn-primary">
                                <spinner v-if="userEmail.busy"></spinner>
                                <span><i class="fa fa-envelope"></i>  SEND</span>
                            </btn-submit>
                        </div>
                    </div>
                </form-submit>
            </div>
        </div>
    </div>
</template>
<style>

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
                    this.$emit('newEmail');
                });
            },

        }
    }
</script>