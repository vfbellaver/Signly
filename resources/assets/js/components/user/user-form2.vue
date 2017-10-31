<template>
    <form-submit v-model="form" @submit="save">
        <row>
            <column size="4">
                <form-group :form="form" field="photo_url">
                    <input-label for="photo_url">Photo: </input-label>
                    <image-upload v-model="form.photo_url" id="photo_url" name="photo_url"></image-upload>
                </form-group>
            </column>

            <column size="8">

                <form-group :form="form" field="name">
                    <input-label for="name">Name: </input-label>
                    <input-text v-model="form.name" id="name" name="name"/>
                </form-group>

                <form-group :form="form" field="email">
                    <input-label for="email">Email: </input-label>
                    <input-email v-model="form.email" id="email" name="email"/>
                </form-group>

                <form-group :form="form" field="password">
                    <input-label for="password">Password: </input-label>
                    <input-text v-model="form.password" id="password" name="password"/>
                </form-group>

                <form-group :form="form" field="role">
                    <input-label for="role">Role: </input-label>
                    <roles-select v-model="form.role" id="role" name="role"/>
                </form-group>
            </column>
        </row>
        <modal-footer>
            <btn-submit :disabled="form.busy">
                <spinner v-if="form.busy"></spinner>
                <span v-if="form.id">Save</span>
                <span v-else>Invite</span>
            </btn-submit>
        </modal-footer>
    </form-submit>
</template>

<script>

    import RolesSelect from '../role/role-select';
    import ModalForm from '../shared/Mixins/ModalForm';

    export default {
        mixins: [ModalForm],
        components: {
            RolesSelect,
        },
        data() {
            return {
                api: 'user',
                form: new SlcForm({}),
            }
        },

        created(){

        },

        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Invite')} User`;
            }
        },
        methods: {
            buildForm(user) {
                return new SlcForm(Slc.user);
            }
        },

        reload() {
            Slc.get(laroute.route('api.user.index'))
                .then((response) => {
                    this.user = response;
                    this.user = this.user[0];
                });
        },

    }
</script>