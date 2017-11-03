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
                        <h1>Profile Settings  <i class=""></i></h1>
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
                                <li>
                                    <a data-toggle="tab" href="#tab-testea" aria-expanded="false">
                                        <i class="fa fa-fw fa-btn fa-edit"></i>
                                        Test Profile 1
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-testeb" aria-expanded="false">
                                        <i class="fa fa-fw fa-btn fa-edit"></i>
                                        Test Profile 2
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content ">
                                <div id="tab-user-profile" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>Update Your Profile</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <form-submit v-model="form" @submit="save">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <form-group :form="form" field="name">
                                                                <input-label for="name">Name: </input-label>
                                                                <input-text v-model="form.name" id="name"
                                                                            name="name"></input-text>
                                                            </form-group>
                                                            <form-group :form="form" field="email">
                                                                <input-label for="email">Email: </input-label>
                                                                <input-email v-model="form.email" id="email"
                                                                             name="email"/>
                                                            </form-group>
                                                            <hr>
                                                            <div>
                                                                <button type="submit" class="btn btn-primary">
                                                                    Update Profile
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="text-center">
                                                                <form-group :form="form" field="photo">
                                                                    <image-upload v-model="form.photo_url"
                                                                                  id="photo"
                                                                                  name="photo"></image-upload>
                                                                </form-group>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form-submit>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-security" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>Update Your Password <i class="fa fa-lock"></i></h5>
                                            </div>
                                            <div class="ibox-content">
                                                <form-submit v-model="formPw" @submit="updatePw">
                                                    <div class="content clearfix">
                                                        <div class="col-lg-12">
                                                            <form-group :form="formPw" field="password">
                                                                <input-label for="password">Current password:
                                                                </input-label>
                                                                <input-text v-model="formPw.password"
                                                                            id="password"
                                                                            name="password"
                                                                            type="password"></input-text>
                                                            </form-group>
                                                            <form-group :form="formPw" field="new_password">
                                                                <input-label for="new_password">New password:
                                                                </input-label>
                                                                <input-text v-model="formPw.new_password"
                                                                            id="new_password"
                                                                            name="new_password"
                                                                            type="password"></input-text>
                                                            </form-group>
                                                            <form-group :form="formPw" field="confirm_password">
                                                                <input-label for="confirm_password">Confirm password:
                                                                </input-label>
                                                                <input-text v-model="formPw.confirm_password"
                                                                            id="confirm_password"
                                                                            name="confirm_password"
                                                                            type="password"></input-text>
                                                            </form-group>
                                                            <hr>
                                                            <div>
                                                                <button type="submit" class="btn btn-primary">
                                                                    Update Password
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form-submit>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-testea" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="ibox">
                                            <form-submit v-model="form" @submit="save">
                                                <div class="col-lg-3" style="padding-left: 0px">
                                                    <div class="ibox-title">
                                                        <h5>Update Your Photo</h5>
                                                    </div>
                                                    <div class="ibox-content">

                                                        <form-group :form="form" field="photo">
                                                            <image-upload v-model="form.photo_url"
                                                                          id="photo"
                                                                          name="photo"></image-upload>
                                                        </form-group>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9" style="padding-right: 0px;">
                                                    <div class="ibox-title">
                                                        <h5>Update Profile Photo</h5>
                                                    </div>
                                                    <div class="ibox-content" style="min-height: 262px">
                                                        <form-group :form="form" field="name">
                                                            <input-label for="name">Name: </input-label>
                                                            <input-text v-model="form.name" id="name"
                                                                        name="name"></input-text>
                                                        </form-group>
                                                        <form-group :form="form" field="email">
                                                            <input-label for="email">Email: </input-label>
                                                            <input-email v-model="form.email" id="email" name="email"/>
                                                        </form-group>
                                                        <hr>
                                                        <div>
                                                            <button type="submit" class="btn btn-primary">
                                                                Update Profile
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form-submit>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-testeb" class="tab-pane">
                                    <div class="panel-body">
                                        <form-submit v-model="form" @submit="save">
                                            <div class="ibox">
                                                <div class="ibox-title">
                                                    <h3>Account Settings</h3>
                                                </div>
                                                <div class="ibox-content">
                                                    <div class="contact-box center-version">
                                                        <div class="img">
                                                            <img-upload2 v-model="form.photo_url"
                                                                         id="photo"
                                                                         name="photo"></img-upload2>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="ibox">
                                                <div class="ibox-title">
                                                    <h3>Account Settings</h3>
                                                </div>
                                                <div class="ibox-content">
                                                    <form-group :form="form" field="name">
                                                        <input-label for="name">Name: </input-label>
                                                        <input-text v-model="form.name" id="name"
                                                                    name="name"></input-text>
                                                    </form-group>
                                                    <form-group :form="form" field="email">
                                                        <input-label for="email">Email: </input-label>
                                                        <input-email v-model="form.email" id="email"
                                                                     name="email"/>
                                                    </form-group>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">
                                                            Update Profile
                                                        </button>
                                                    </div>
                                                    <hr>
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
</template>
<style lang="scss" scoped="scoped">
    .img {
        max-width: 30%;
        min-height: 100px;
        margin-top: 10px;
        margin-bottom: 10px;
        margin-left: auto;
        margin-right: auto;
    }
    .contact-box.center-version {
        border: none;
    }

        .ibox {
        clear: none;
        margin-top: 0;
    }

    .ibox-content {
        clear: none;
    }

    .panel-body {
        padding: 0 0 0 20px;
        border: solid;
    }

    .box-photo {
        padding-left: 0;
    }

    .box-user-settings {
        padding-right: 0;
        min-height: 357px;
    }

    .tabs-container .tabs-left >
    .nav-tabs .active > a, .tabs-container
    .tabs-left > .nav-tabs .active > a:hover,
    .tabs-container .tabs-left > .nav-tabs
    .active > a:focus {
        border-left: 4px solid #53abd3;
        background-color: white;
    }

    .tabs-container .tabs-left
    .tab-pane .panel-body,
    .tabs-container .tabs-right
    .tab-pane .panel-body {
        border-top: 1px solid #f3f3f5;
        border-color: #f3f3f5;
        background-color: #f3f3f5;

    }
</style>
<script>
    import ImgUpload2 from './../shared/Inputs/ImageUpload2';
    export default {
        components: {
            ImgUpload2,
        },
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
                console.log('Update password', this.formPw);
                Slc.put(uri, this.formPw).then((response) => {
                    console.log("Password Update", response);
                });
            },
        }
    }
</script>