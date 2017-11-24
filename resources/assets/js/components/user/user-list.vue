<template>
    <div class="client-list">
        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>

        <nav class="navbar navbar-in-content navbar-default" data-spy="affix" data-offset-top="147">
            <ul class="nav navbar-nav navbar-right">

            </ul>
        </nav>

        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <box>
                    <box-content>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 36px"></th>
                                    <th>Name</th>
                                    <th style="width: 128px">Email</th>
                                    <th style="width: 128px">Role</th>
                                    <th style="width: 36px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="( user, index ) in users">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.role.name }}</td>
                                    <td v-if="!loggedUser.impersonated">
                                        <btn-success size="xs"
                                                     data-toggle="tooltip"
                                                     title="Impersonate"
                                                     :disabled="loggedUser.id == user.id"
                                                     @click.native="impersonate(user)">
                                            <spinner v-if="user.busy"></spinner>
                                            <icon icon="user-secret" v-else></icon>
                                        </btn-success>
                                    </td>
                                    <td v-else>
                                        <btn-danger v-if="loggedUser.id == user.id" size="xs"
                                                    data-toggle="tooltip"
                                                    title="Leave Impersonation"
                                                    @click.native="leaveImpersonation(user)">
                                            <spinner v-if="user.busy"></spinner>
                                            <icon icon="user-secret" v-else></icon>
                                        </btn-danger>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </box-content>
                </box>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        components: {},
        data() {
            return {
                impersonating: false,
                loggedUser: window.Slc.user,
                users: [],
                pageHeading: {
                    title: 'User List',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')}
                    ]
                },
            }
        },

        mounted() {
            this.reload();
        },

        methods: {
            impersonate(user) {
                user.busy = true;
                window.location = laroute.route('impersonate', {id: user.id});
            },

            leaveImpersonation(user) {
                user.busy = true;
                window.location = laroute.route('impersonate.leave', {id: user.id});
            },

            reload() {
                let self = this;
                Slc.get(laroute.route('api.user.index'))
                    .then((response) => {
                        response.forEach(function (obj) {
                            obj.busy = false;
                        });
                        self.users = response;
                        this.$nextTick(() => {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    });
            },

            findIndex(user) {
                return this.users.findIndex((_user) => {
                    return _user.id === user.id;
                });
            }
        }
    }
</script>