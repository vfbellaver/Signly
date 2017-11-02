<template>
    <div>

        <tr v-for="( user, index ) in users">
            <td class="client-avatar"><img alt="image" :src="user.photo_url"></td>
            <td v-if="boss.email === user.email">{{user.name + "  "}}<strong>you</strong></td>
            <td v-else>{{user.name}}</td>
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

    </div>
</template>
<style>

</style>
<script>

    import * as SLC from '../../vue/http'

    export default {
        data() {
            return {
                users: [],
                boss: Slc.user
            }
        },

        created(){
            this.invitations();
        },

        methods: {
            invitations(){
                SLC.get(laroute.route('api.team.list.invited.members')).then((response) => {
                    this.users = response;
                });
            },

            destroy(user) {
                let self = this;
                SLC.delete(laroute.route('api.user.destroy', {user: user.id}), user.destroyForm)
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