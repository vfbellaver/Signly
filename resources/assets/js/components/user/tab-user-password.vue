<template>
    <div>
        <form-submit v-model="formPw" @submit="updatePw" class="wizard-big wizard clearfix">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Update Password</h5>
                </div>
                <div class="ibox-content">
                    <row>
                        <div class="col-lg-12">
                            <form-group :form="formPw" field="current_password">
                                <input-label for="current_password">Current password:
                                </input-label>
                                <input-text v-model="formPw.current_password"
                                            id="current_password"
                                            name="current_password"
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
                                <button type="submit" class="btn btn-primary">Update Password
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
                formPw: new SlcForm(),
                pageHeading: {
                    title: 'User Settings',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')}
                    ]
                },
            }
        },

        methods: {
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