<template>
    <div class="col-lg-8 col-lg-offset-2">
        <h2><i class="fa fa-user"></i> Password </h2>
        <div class="divider"></div>
        <form-submit v-model="userForm" @submit="updatePassword">
            <column size="12">
                <form-group :form="userForm" field="current_password">
                    <input-label for="current_password">Current Password: </input-label>
                    <input-password type="password" v-model="userForm.current_password" id="current_password"
                                    name="current_password"></input-password>
                </form-group>
            </column>
            <column size="12">
                <form-group :form="userForm" field="password">
                    <input-label for="password">Password: </input-label>
                    <input-password type="password" v-model="userForm.password" id="password"
                                    name="password"></input-password>
                </form-group>
            </column>
            <column size="12">
                <form-group :form="userForm" field="password_confirm">
                    <input-label for="password">Confirm Password: </input-label>
                    <input-password type="password" v-model="userForm.password_confirm" id="password_confirm"
                                    name="password_confirm">
                    </input-password>
                    <span v-if="userForm.password_confirm != userForm.password" class="help-block">
                                <strong>{{ 'please check password confirmation field' }}</strong>
                            </span>
                </form-group>
            </column>
            <div class="col-md-12">
                <hr>
                <btn-submit :disabled="userForm.busy">
                    <spinner v-if="userForm.busy"></spinner>
                </btn-submit>
            </div>
        </form-submit>
    </div>
</template>

<style>
    .divider {
        height: 3px;
        margin: 15px;
        background-color: rgba(2, 118, 160, 0.74);
        border-radius: 3px 3px 3px 3px;

    }
</style>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";

    export default {
        props: {
            user: {required: true},
        },
        components: {},

        data() {
            return {
                userForm: null,
            }
        },

        created() {
            this.userForm = new SlcForm({
                current_password: '',
                password: '',
                password_comfirm: '',
            });

        },

        watch: {

        },
        methods: {
            updatePassword() {
                const uri = laroute.route('api.user.update.password', {user: this.user.id});
                Slc.put(uri, this.userForm).then((response) => {
                    console.log("Password saved", response);
                })
            },
        }
    }
</script>