<template>
    <div>
        <form-submit v-model="user" @submit="saveUser" class="wizard-big wizard clearfix">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Photo Porfile</h5>
                </div>
                <div class="ibox-content">
                    <row>
                        <div class="col-lg-4 col-sm-4 col-xs-12">
                            <form-group :form="user" field="photo_url">
                                <image-upload v-model="user.photo_url"
                                              id="photo_url"
                                              name="photo_url"></image-upload>
                            </form-group>
                        </div>
                    </row>
                    <row>
                        <div class="col-xs-12">
                            <hr>
                            <button type="submit" class="btn btn-primary">Update Photo
                            </button>
                        </div>
                        <div class="clear"></div>
                    </row>
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-title">
                    <h5>User Settings</h5>
                </div>
                <div class="ibox-content">
                    <row>
                        <div class="col-lg-12">

                            <form-group :form="user" field="name">
                                <input-label for="name">Name: </input-label>
                                <input-text v-model="user.name" id="name"
                                            name="name"></input-text>
                            </form-group>

                            <form-group :form="user" field="email">
                                <input-label for="email">Email: </input-label>
                                <input-text v-model="user.email" id="email"
                                            name="email"></input-text>
                            </form-group>
                            <hr>
                            <div>
                                <button type="submit" class="btn btn-primary">Update Profile
                                </button>
                            </div>
                        </div>
                    </row>
                    <div class="clear"></div>
                </div>
            </div>
        </form-submit>
    </div>
</template>
<style lang="scss" scoped="scoped">

    .ibox {
        clear: none;
        margin-bottom: 60px;
        margin-top: -20px;
        padding: 0;
    }

    hr {
        margin-top: 1px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #eeeeee;
    }

    .row:before, .row:after {
        content: " ";
        display: none;
    }

    .ibox-content {
        clear: none;
    }

    .clear {
        clear: both;
    }
</style>
<script>

    export default {
        data() {
            return {
                user: Slc.user,
                pageHeading: {
                    title: 'User Settings',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')}
                    ]
                },
            }
        },
        created(){
            this.user = new SlcForm(Slc.user);
        },

        methods: {
            saveUser(){
                const uri = laroute.route('api.user.update', {user: Slc.user.id});
                Slc.put(uri, this.user).then((response) => {
                    console.log("User Update", response);
                });
            },
        }
    }
</script>