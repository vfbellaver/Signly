<template>
    <modal size="lg">
        <modal-header>{{ title }}</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="12">
                        <form-group :form="form" field="time_frame">
                            <input-label for="time_frame">Time frame: </input-label>
                            <input id="time_frame" ref="timeFrame" type="text" class="form-control"/>
                        </form-group>
                        <form-group :form="form" field="name">
                            <input-label for="name">Name: </input-label>
                            <input-text v-model="form.name" id="name" name="name"></input-text>
                        </form-group>
                        <form-group :form="form" field="client">
                            <input-label for="client">Client: </input-label>
                            <client-select v-model="form.client" id="client" name="client"></client-select>
                        </form-group>
                        <form-group :form="form" field="budget">
                            <input-label for="budget">Budget: </input-label>
                            <input-text v-model="form.budget" id="budget" name="budget" v-money></input-text>
                        </form-group>
                        <form-group :form="form" field="confidence">
                            <input-label for="confidence">Confidence: {{form.confidence}}% </input-label>
                            <input id="confidence" v-model="form.confidence" type="range" min="0" max="100" step="1"/>
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
    import * as _ from "lodash";

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
        mounted() {

        },
        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Add')} Proposal`;
            },
        },
        methods: {
            buildForm(proposal) {
                const self = this;
                const form = new SlcForm({
                    id: proposal ? proposal.id : null,
                    name: proposal ? proposal.name : null,
                    client: proposal ? proposal.client : null,
                    from_date: proposal ? proposal.from_date : moment().format('MM/DD/YYYY'),
                    to_date: proposal ? proposal.to_date : moment().add('months', 3).format('MM/DD/YYYY'),
                    confidence: proposal ? proposal.confidence : 50,
                    user_id: proposal ? proposal.user_id : null,
                });

                $(this.$refs.timeFrame).daterangepicker({
                    "alwaysShowCalendars": true,
                    "startDate": form.from_date,
                    "endDate": form.to_date,
                }, function (start, end) {
                    console.log('Time frame changed', start, end);
                    self.form.from_date = start.format('MM/DD/YYYY');
                    self.form.to_date = end.format('MM/DD/YYYY');
                });

                return form;
            }
        }
    }
</script>