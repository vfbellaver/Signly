<template>
    <div>
        <team-membership @newEmail="mailedInvitations"></team-membership>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Invited List
                    <small class="m-l-sm">
                        Here is your team and the invited members Listed
                    </small>
                </h5>
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
                                    <td> {{user.email}}</td>
                                    <td class="client-status">
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
                <h5>{{boss.team.name}}
                    <small class="m-l-sm">
                        Here is your team and the invited members Listed
                    </small>
                </h5>
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
                                        <td> {{user.email}}</td>
                                        <td class="client-status">
                                            <btn-danger class="pull-rigth"
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

    import * as SLC from '../../vue/http';
    import TeamMembership from './team-membership';

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
                boss: Slc.user
            }
        },

        created(){
            this.invitations();
            this.mailedInvitations();
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
            },

            mailedInvitations(){
                Slc.get(laroute.route('api.team.list.mailed.invitations')).then((response) => {
                    this.mailed = response;
                    console.log('mailed');
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

            nextPage(){
                this.page1 = !this.page1;
                this.page2 = !this.page2;
            },
        }
    }
</script>