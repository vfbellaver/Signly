<template>
    <div>
        <h2>Invite a Member</h2>
        <form-submit v-model="userEmail" @submit="sendEmail">
            <form-group :form="userEmail" field="email">
                <input-label for="email">Email: </input-label>
                <input-text v-model="userEmail.email" id="email" name="email"></input-text>
            </form-group>

            <btn-submit class="pull-right">
                <spinner v-if="userEmail.busy"></spinner>
                <span><i class="fa fa-envelope"></i>  SEND</span>
            </btn-submit>
        </form-submit>

        <h2>Mailed Invitations</h2>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody>
                <tr v-for="( user, index ) in users">
                    <td class="client-avatar"><img alt="image" src="/images/user.png"></td>
                    <td><strong>Invited</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                    <td> {{user.email}}</td>
                    <td class="client-status">
                        <btn-danger
                                @click.native="destroy(user)"
                                :disabled="user.destroyForm.busy"
                                size="xs">
                            <spinner v-if="user.destroyForm.busy"></spinner>
                            <icon icon="trash" v-else></icon>
                        </btn-danger>
                    </td>
                </tr>
                </tbody>
            </table>
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
                users: [],
            }
        },

        created(){
            this.userEmail = new SlcForm({
                email: '',
            });

            this.mailedInvitations();
        },

        methods: {
            sendEmail(){
                const uri = laroute.route('api.team.invite.member');
                Slc.post(uri, this.userEmail).then((response) => {
                    this.mailedInvitations();
                });
            },

            mailedInvitations(){
                Slc.get(laroute.route('api.team.list.mailed.invitations')).then((response) => {
                    this.users = response;
                    console.log('users');
                });
            },

            destroy(user) {
                let self = this;
                Slc.delete(laroute.route('api.user.destroy', {user: user.id}), user.destroyForm)
                    .then(() => {
                        self.removeUser(user);
                    });
            },

            removeUser(user) {
                this.users.splice(this.findIndex(user), 1);
            },

            findIndex(user) {
                return this.users.findIndex((_user) => {
                    return _user.id === user.id;
                });
            }

        }
    }
</script>