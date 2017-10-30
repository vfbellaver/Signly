<template>
    <div>
        <form-submit v-model="userForm" @submit="verifyUser">
            <column size="12">
                <form-group :form="userForm" field="team">
                    <input-label class="pull-left" for="team">Team: </input-label>
                    <input-text v-model="userForm.team" id="team"
                                name="team"></input-text>
                </form-group>
            </column>
            <column size="12">
                <form-group :form="userForm" field="name">
                    <input-label class="pull-left" for="name">Name: </input-label>
                    <input-text v-model="userForm.name" id="name"
                                name="name"></input-text>
                </form-group>
            </column>
            <column size="12">
                <form-group :form="userForm" field="email">
                    <input-label class="pull-left" for="email">Email: </input-label>
                    <input-text v-model="userForm.email" id="email"
                                name="email"></input-text>
                </form-group>
            </column>
            <column size="12">
                <form-group :form="userForm" field="password">
                    <input-label class="pull-left" for="password">Password: </input-label>
                    <input-password type="password" v-model="userForm.password" id="password"
                                    name="password"></input-password>
                </form-group>
            </column>
            <column size="12">
                <form-group :form="userForm" field="password_confirm">
                    <input-label class="pull-left" for="password">Confirm Password: </input-label>
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
                <btn-submit class="pull-right" :disabled="userForm.busy">
                    <spinner v-if="userForm.busy"></spinner>
                </btn-submit>
            </div>
        </form-submit>
    </div>
</template>

<style>

</style>

<script>

    import * as Slc from "../../vue/http";

    export default {

        props: {
            plan: {required: true},
        },

        components: {},

        data() {
            return {
                userForm: null,
            }
        },

        created() {
            this.userForm = new SlcForm({
                name: '',
                team: '',
                plan: this.plan.plan,
                email: '',
                password: '',
                password_confirm: '',
            })

        },

        watch: {},
        methods: {
            verifyUser() {
                const uri = laroute.route('api.payment.verify.user');
                Slc.post(uri, this.userForm).then((response) => {
                    this.$emit('verify',{user:response.data});
                });
            },
        }
    }
</script>