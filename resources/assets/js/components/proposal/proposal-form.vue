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
                        <form-group :form="form" field="client">
                            <input-label for="client">Client: </input-label>
                            <client-select v-model="form.client" id="client" name="client"></client-select>
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
    import ClientSelect from '../client/client-select';

    export default {
        mixins: [ModalForm],
        components: {
            ClientSelect,
        },

        data() {
            return {
                api: 'proposal'
            }
        },
        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Add')} Proposal`;
            }
        },
        methods: {
            buildForm(proposal) {
                return new SlcForm({
                    id: proposal ? proposal.id : null,
                    name: proposal ? proposal.name : null,
                    client: proposal ? proposal.client : null,
                });
            }
        }
    }
</script>