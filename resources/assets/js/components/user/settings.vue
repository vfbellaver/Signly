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
                                                    <h3>Profile photo:</h3>
                                                    <hr>
                                                    <form-group :form="form" field="photo">
                                                        <image-upload v-model="form.photo_url" id="photo"
                                                                      name="photo"></image-upload>
                                                    </form-group>
                                                    <hr>
                                                </column>

                                                <column size="8">
                                                    <h3>Contact Information</h3>
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
                                                    <hr>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">Update Profile
                                                        </button>
                                                    </div>
                                                    <div>
                                                    </div>
                                                </column>
                                            </form-submit>

                                        </ul>
                                    </div>
                                </div>
                                <div id="tab-security" class="tab-pane">
                                    <div class="panel-body">
                                        <ul>
                                            <form-submit v-model="form" @submit="updatePw">
                                                <h3>Update your Password</h3>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="password" class="col-md-4 control-label">Password</label>
                                                    <input id="password" type="password" class="form-control" name="password" v-model="form.password">
                                                </div>

                                                <div class="form-group">
                                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                                </div>
                                                <hr>
                                                <div>
                                                    <button type="submit" class="btn btn-primary">Update Password
                                                    </button>
                                                </div>
                                            </form-submit>
                                        </ul>
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
    h3 {
        margin-top: 0;
    }

    hr {
        border: solid 2px;
        border-color: #43A3D0;
    }
</style>
<script>
    export default {
        data() {
            return {
                form: null,
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
              console.log('Update pass!!');
            },
        }
    }
</script>