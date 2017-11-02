<template>
    <div>
        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>

        <nav class="navbar navbar-in-content navbar-default" data-spy="affix" data-offset-top="147">
            <ul class="nav navbar-nav navbar-right"></ul>
        </nav>

        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <h1>Team Settings</h1>
                        <div class="tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab-user-profile" aria-expanded="true">
                                        <i class="fa fa-fw fa-btn fa-edit"></i>
                                        User profile
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-security" aria-expanded="false">
                                        <i class="fa fa-fw fa-btn fa-lock"></i>
                                        Security
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content ">
                                <div id="tab-user-profile" class="tab-pane active">
                                    <div class="panel-body">
                                        <ul>
                                            <form-submit v-model="form" @submit="save">
                                                <column size="4">
                                                    <h3><strong>Profile Photo</strong></h3>
                                                    <hr>
                                                    <form-group :form="form" field="photo">
                                                        <image-upload v-model="form.photo_url" id="photo"
                                                                      name="photo"></image-upload>
                                                    </form-group>
                                                </column>

                                                <column size="8">
                                                    <h3><strong>Contact Information</strong></h3>
                                                    <hr>

                                                    <form-group :form="form" field="name">
                                                        <input-label for="name">Name: </input-label>
                                                        <input-text v-model="form.name" id="name"
                                                                    name="name"></input-text>
                                                    </form-group>
                                                    <form-group :form="form" field="email">
                                                        <input-label for="email">Email: </input-label>
                                                        <input-email v-model="form.email" id="email" name="email"/>
                                                    </form-group>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">Update Profile
                                                        </button>
                                                    </div>
                                                </column>
                                            </form-submit>
                                        </ul>
                                    </div>
                                </div>
                                <div id="tab-security" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="col-lg-12">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-title">
                                                    <h3>Update Password  <i class="fa fa-fw fa-btn fa-lock"></i></h3>
                                                </div>
                                                <div class="ibox-content">
                                                    <form-submit v-model="formPw" @submit="updatePw">
                                                        <div class="col-lg-8">
                                                            <div class="form-group">
                                                                <label>Current Password *</label>
                                                                <input id="old_password" name="old_password"
                                                                       type="password"
                                                                       class="form-control required"
                                                                       aria-required="true"
                                                                       placeholder="Current Password"
                                                                       v-model="formPw.old_password">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>New Password *</label>
                                                                <input id="new_password" name="new_password"
                                                                       type="password"
                                                                       class="form-control required"
                                                                       aria-required="true"
                                                                       placeholder="New Password"
                                                                       v-model="formPw.new_password">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Confirm new Password *</label>
                                                                <input id="confirm" name="confirm" type="password"
                                                                       class="form-control required"
                                                                       aria-required="true"
                                                                       placeholder="Confirm Password"
                                                                       v-model="formPw.confirm">
                                                            </div>
                                                            <div>
                                                                <button type="submit" class="btn btn-primary">
                                                                    Update Password
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="text-center">
                                                                <div style="margin-top: 20px">
                                                                    <i class="fa fa-expeditedssl"
                                                                       style="font-size: 180px;color: #f0f0f0 "></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form-submit>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped="scoped">
    label {
        padding: 0;
    }
    .ibox {
        clear: none;
        margin-top: 0;
    },
    .ibox-content {
        padding-left: 0;
    }
</style>
<script>
    export default {
        data() {
            return {
                form: null,
                formPw: new SlcForm(),
                pageHeading: {
                    title: 'User Settings',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')}
                    ]
                },
            }
        },
        created() {
            this.form = new SlcForm(Slc.user);
        },

        methods: {
            save(){
                const uri = laroute.route('api.user.update', {user: Slc.user.id});
                Slc.put(uri, this.form).then((response) => {
                    console.log("User Update", response);
                })
            },
            updatePw(){
                const uri = laroute.route('api.user.update.password', {user: Slc.user.id});

                Slc.put(uri, this.formPw).then((response) => {
                    console.log("Password Update", response);
                })
            },
        }
    }
</script>