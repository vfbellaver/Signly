<template>
    <modal size="lg">
        <modal-header>{{ title }}</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="12">
                        <form-group :form="form" field="price">
                            <input-label for="price">Price: </input-label>
                            <input-text v-model="form.price" id="price" name="price" v-money></input-text>
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
    import ModalForm from '../../shared/Mixins/ModalForm';
    import * as _ from "lodash";

    export default {
        mixins: [ModalForm],
        components: {},

        data() {
            return {
                api: 'billboardFace',
                route: {
                    store: 'api.proposal.add-billboard-face',
                    update: 'api.proposal.update-billboard-face',
                }
            }
        },
        mounted() {

        },
        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Add')} Billboard Face`;
            },
        },
        methods: {
            buildForm() {
                const form = new SlcForm({});

                return form;
            }
        }
    }
</script>