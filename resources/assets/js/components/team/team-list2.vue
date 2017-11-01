<template>
    <div>
        <div class="ibox">
            <div class="ibox-content">
                <span class="text-muted small pull-right">Last modification: <i class="fa fa-clock-o"></i> 2:10 pm - 12.06.2014</span>
                <h2>Clients</h2>
                <p>
                    All clients need to be verified before you can send email and set a project.
                </p>
                <div class="input-group">
                    <input type="text" placeholder="Search client " class="input form-control">
                    <span class="input-group-btn">
                                        <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                                </span>
                </div>
                <div class="clients-list">
                    <ul class="nav nav-tabs">
                        <span class="pull-right small text-muted">1406 Elements</span>
                        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"><i
                                class="fa fa-user"></i> Contacts</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false"><i
                                class="fa fa-briefcase"></i> Companies</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="slimScrollDiv"
                                 style="position: relative; overflow: hidden; width: auto; height: 100%;">
                                <div class="full-height-scroll" style="overflow: hidden; width: auto; height: 100%;">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                            <tr>
                                                <td class="client-avatar"><img alt="image" src="img/a2.jpg"></td>
                                                <td><a data-toggle="tab" href="#contact-1" class="client-link"
                                                       aria-expanded="true">Anthony Jackson</a></td>
                                                <td> Tellus Institute</td>
                                                <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                                <td> gravida@rbisit.com</td>
                                                <td class="client-status"><span
                                                        class="label label-primary">Active</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="slimScrollBar"
                                     style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 365.112px;"></div>
                                <div class="slimScrollRail"
                                     style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="slimScrollDiv"
                                 style="position: relative; overflow: hidden; width: auto; height: 100%;">
                                <div class="full-height-scroll" style="overflow: hidden; width: auto; height: 100%;">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                            <tr>
                                                <td><a data-toggle="tab" href="#company-1" class="client-link"
                                                       aria-expanded="false">Tellus Institute</a></td>
                                                <td>Rexton</td>
                                                <td><i class="fa fa-flag"></i> Angola</td>
                                                <td class="client-status"><span
                                                        class="label label-primary">Active</span></td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="slimScrollBar"
                                     style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 365.112px;"></div>
                                <div class="slimScrollRail"
                                     style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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