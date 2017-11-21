<template>
    <div>
        <team-membership @newEmail="mailedInvitations"></team-membership>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Invitations Sent</h5>
            </div>
            <div class="ibox-content">
                <div class="clients-list">
                    <div style="overflow: auto; max-height: 280px">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tbody>
                                <tr v-for="( user, index ) in mailed">
                                    <td class="client-avatar"><img alt="image" src="/images/user.png"></td>
                                    <td style="width: 400px"><strong>Waiting Confirmation...</strong></td>
                                    <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                    <td style="width:56%"> {{user.email}}</td>
                                    <td style="width: 36px;" class="client-status">
                                        <btn-danger class="pull-rigth"
                                                    @click.native="destroyMailed(user)"
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
                </div>
            </div>
        </div>

        <div class="ibox">
            <div class="ibox-title">
                <h5>{{boss.team.name}}</h5>
            </div>
            <div class="ibox-content">
                <div class="clients-list">
                    <div class="tab-content">
                        <div style="overflow: auto; max-height: 280px">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    <tr v-for="( user, index ) in users">
                                        <td class="client-avatar"><img alt="image" :src="user.photo_url"></td>
                                        <td v-if="boss.email === user.email">
                                            {{user.name + "  "}}<strong>you</strong></td>
                                        <td v-else>{{user.name}}</td>
                                        <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                        <td style="width:60%"> {{user.email}}</td>
                                        <td style="width: 36px;" class="client-status">
                                            <btn-danger class="pull-rigth"
                                                        @click.native="destroy(user)"
                                                        :disabled="boss.email === user.email ? true : user.destroyForm.busy"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped="scoped">
    .table {
        margin-top: 10px;
    }

    .invited_tr tr {
        width: 30%;
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

    import TeamMembership from './team-membership';
    import * as Slc from "../../vue/http";

    export default {

        components: {
            TeamMembership
        },

        data() {
            return {
                users: [],
                mailed: [],
                page1: true,
                page2: false,
                boss: window.Slc.user,
            }
        },

        created() {
            this.invitations();
            this.mailedInvitations();
        },

        methods: {
            invitations() {
                Slc.get(laroute.route('api.team.list.invited.members')).then((response) => {
                    this.users = response;
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
            },

            mailedInvitations() {
                Slc.get(laroute.route('api.team.list.mailed.invitations')).then((response) => {
                    console.log('mailed');
                    this.mailed = response;
                });
            },

            destroyMailed(user) {
                let self = this;
                Slc.delete(laroute.route('api.user.destroy', {user: user.id}), user.destroyForm)
                    .then(() => {
                        self.removeMailed(user);
                    });
            },

            removeMailed(user) {
                this.mailed.splice(this.findMailed(user), 1);
            },

            findMailed(user) {
                return this.mailed.findIndex((_user) => {
                    return _user.id === user.id;
                });

            },
        }
    }
</script>