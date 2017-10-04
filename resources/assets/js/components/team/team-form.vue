<template>
    <modal>
        <modal-header>{{ title }}</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="12">
                        <form-group :form="form" field="name">
                            <input-label for="name">Name: </input-label>
                            <input-text v-model="form.name" id="name" name="name"></input-text>
                        </form-group>
                    </column>
                </row>
            </modal-body>

            <modal-footer>
                <btn-submit :disabled="form.busy">
                    <spinner v-if="form.busy"></spinner>
                </btn-submit>
            </modal-footer>
        </form-submit>
    </modal>
</template>

<script>
    import ModalForm from '../shared/Mixins/ModalForm';

    export default {
        mixins: [ModalForm],

        data() {
            return {
                api: 'team'
            }
        },
        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Add')} Team`;
            }
        },

        methods: {
            buildForm(team) {
                return new SlcForm({
                    id: team ? team.id : null,
                    name: team ? team.name : null,
                });
            }
        }
    }
</script>