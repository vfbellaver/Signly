<template>
    <div>
        <div class="ibox">
            <form-submit v-model="formPhoto" @submit="updatePhoto" class="wizard-big wizard clearfix">
                <div class="ibox-title">
                    <h5>Photo Porfile</h5>
                </div>
                <div class="ibox-content">
                    <row>
                        <div class="col-lg-4 col-sm-4 col-xs-12">
                            <form-group :form="formPhoto" field="photo_url">
                                <image-upload v-model="formPhoto.photo_url"
                                              id="photo_url"
                                              name="photo_url"></image-upload>
                            </form-group>
                        </div>
                    </row>
                    <row>
                        <div class="col-xs-12">
                            <hr>
                            <button type="submit" class="btn btn-primary" :disabled="formPhoto.busy">
                                <spinner v-if="formPhoto.busy"></spinner>
                                Update Photo
                            </button>
                        </div>
                        <div class="clear"></div>
                    </row>
                </div>
            </form-submit>
        </div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>User Settings</h5>
            </div>
            <div class="ibox-content">
                <form-submit v-model="formUser" @submit="saveUser" class="wizard-big wizard clearfix">
                    <row>
                        <div class="col-lg-12">
                            <form-group :form="formUser" field="name">
                                <input-label for="name">Name: </input-label>
                                <input-text v-model="formUser.name" id="name"
                                            name="name"></input-text>
                            </form-group>

                            <form-group :form="formUser" field="email">
                                <input-label for="email">Email: </input-label>
                                <input-text v-model="formUser.email" id="email"
                                            name="email"></input-text>
                            </form-group>
                            <hr>
                            <div>
                                <button type="submit" class="btn btn-primary" :disabled="formUser.busy">
                                    <spinner v-if="formUser.busy"></spinner>
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </row>
                </form-submit>
                <div class="clear"></div>
            </div>
        </div>

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
                formUser: null,
                formPhoto: null,
                pageHeading: {
                    title: 'User Settings',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')}
                    ]
                },
            }
        },
        created(){
            this.formUser = new SlcForm(Slc.user);
            this.formPhoto = new SlcForm(Slc.user);
        },

        methods: {
            saveUser(){
                const uri = laroute.route('api.user.update', {user: Slc.user.id});
                Slc.put(uri, this.formUser).then((response) => {
                    console.log("User Update", response);
                    EventBus.$emit('userUpdated');
                });
            },
            updatePhoto(){
                const uri = laroute.route('api.user.update.photo', {user: Slc.user.id});
                Slc.put(uri, this.formPhoto).then((response) => {
                    this.formUser = new SlcForm(response.data);
                    console.log("Profile Photo Update", response);
                });
            },
        }
    }
</script>