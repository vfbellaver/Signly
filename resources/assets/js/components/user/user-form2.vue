<template>
    <modal>
        <modal-header>{{ title }}</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="12">

                        <form-group :form="form" field="photo_url">
                            <input-label for="photo_url">Photo: </input-label>
                            <image-upload v-model="form.photo_url" id="photo_url" name="photo_url"></image-upload>
                        </form-group>

                        <form-group :form="form" field="name">
                            <input-label for="name">Name: </input-label>
                            <input-text v-model="form.name" id="name" name="name"/>
                        </form-group>

                        <form-group :form="form" field="email">
                            <input-label for="email">Email: </input-label>
                            <input-email v-model="form.email" id="email" name="email"/>
                        </form-group>

                        <form-group :form="form" field="role">
                            <input-label for="role">Role: </input-label>
                            <roles-select v-model="form.role" id="role" name="role"/>
                        </form-group>

                        <form-group :form="form" field="team">
                            <input-label for="team">Team: </input-label>
                            <teams-select v-model="form.team" id="team" name="team"/>
                        </form-group>

                    </column>
                </row>
            </modal-body>

            <modal-footer>
                <btn-submit :disabled="form.busy">
                    <spinner v-if="form.busy"></spinner>
                    <span v-if="form.id">Save</span>
                    <span v-else>Invite</span>
                </btn-submit>
            </modal-footer>
        </form-submit>
    </modal>
</template>

<script>

    import RolesSelect from '../role/role-select';
    import TeamsSelect from '../team/team-select';
    import ModalForm from '../shared/Mixins/ModalForm';

    export default {
        mixins: [ModalForm],
        components: {
            RolesSelect,
            TeamsSelect
        },
        data() {
            return {
                api: 'user'
            }
        },
        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Invite')} User`;
            }
        },
        methods: {
            buildForm(user) {
                return new SlcForm({
                    id: user ? user.id : null,
                    name: user ? user.name : null,
                    photo_url: user ? user.photo_url : null,
                    email: user ? user.email : null,
                    role: user ? user.role : null,
                    team: user ? user.team : null
                });
            }
        }
    }
</script>