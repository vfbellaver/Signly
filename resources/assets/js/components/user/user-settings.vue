<template>
    <div>
        <box>
            <box-title>
                User Settings
            </box-title>
            <box-content>
                <div class="row">
                    <div class="col-md-6">
                        <box>
                            <box-title>
                                Update Photo
                            </box-title>
                            <box-content>
                                <div class="row">
                                    <div class="col-md-12">
                                        <image-upload v-model="photoUrl" id="photo" name="photo"></image-upload>
                                    </div>
                                </div>
                            </box-content>
                        </box>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <box>
                            <box-title>
                                Update Profile
                            </box-title>
                            <box-content>
                                <form-submit v-model="profileForm" @submit="updateProfile">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form-group :form="profileForm" field="name">
                                                <input-label for="name">Name: </input-label>
                                                <input-text id="name" v-model="profileForm.name"></input-text>
                                            </form-group>
                                            <form-group :form="profileForm" field="email">
                                                <input-label for="email">Email: </input-label>
                                                <input-email id="email" v-model="profileForm.email" name="email"></input-email>
                                            </form-group>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                            <btn-submit :disabled="profileForm.busy">
                                                <spinner v-if="profileForm.busy"></spinner>
                                            </btn-submit>
                                        </div>
                                    </div>
                                </form-submit>
                            </box-content>
                        </box>
                    </div>
                    <div class="col-md-6">
                        <box>
                            <box-title>
                                Update Password
                            </box-title>
                            <box-content>
                                <form-submit v-model="passwordForm" @submit="updatePassword">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form-group :form="passwordForm" field="password">
                                                <input-label for="password">Password: </input-label>
                                                <input-password id="password"
                                                                v-model="passwordForm.password"></input-password>
                                            </form-group>
                                            <form-group :form="passwordForm" field="password_confirm">
                                                <input-label for="password_confirm">Password Password: </input-label>
                                                <input-password id="password_confirm"
                                                                v-model="passwordForm.password_confirm"></input-password>
                                            </form-group>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                            <btn-submit :disabled="passwordForm.busy">
                                                <spinner v-if="passwordForm.busy"></spinner>
                                            </btn-submit>
                                        </div>
                                    </div>
                                </form-submit>
                            </box-content>
                        </box>
                    </div>
                </div>
            </box-content>
        </box>
    </div>
</template>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";

    export default {
        props: {
            user: {required: true},
            settings: {required: true}
        },
        components: {},
        data() {
            return {
                photoUrl: this.user.photo_url,
                passwordForm: new SlcForm({password: null, password_confirm: null}),
                profileForm: new SlcForm({name: null, email: null}),
            }
        },

        created() {
            this.profileForm = new SlcForm({name: this.user.name, email: this.user.email});
        },

        watch: {
            photoUrl(value, oldValue) {
                if (!oldValue) {
                    return;
                }
                this.$nextTick(() => {
                    this.updatePhoto();
                });
            }
        },
        methods: {
            updatePhoto() {
                const uri = laroute.route('api.user.update.photo', {user: this.user.id});
                Slc.put(uri, new SlcForm({photo_url: this.photoUrl})).then((response) => {
                    console.log("Photo saved", response);
                    EventBus.$emit('userUpdated');
                })
            },
            updatePassword() {
                const uri = laroute.route('api.user.update.password', {user: this.user.id});
                Slc.put(uri, this.passwordForm).then((response) => {
                    console.log("Password saved", response);
                })
            },
            updateProfile() {
                const uri = laroute.route('api.user.update', {user: this.user.id});
                Slc.put(uri, this.profileForm).then((response) => {
                    console.log("Profile saved", response);
                    EventBus.$emit('userUpdated');
                })
            }


        }
    }
</script>