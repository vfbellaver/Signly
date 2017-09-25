<template>
    <modal>
        <modal-header>{{ title }}</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="6">
                        <form-group :form="form" field="photo">
                            <input-label for="photo">Photo: </input-label>
                            <image-upload v-model="form.photo" id="photo" name="photo"></image-upload>
                        </form-group>
                    </column>

                    <column size="6">
                        <column size="12">
                            <form-group :form="form" field="unique">
                                <input-label for="unique">Unique: </input-label>
                                <input-text v-model="form.unique" id="unique" name="unique"></input-text>
                            </form-group>
                        </column>

                        <column size="12">
                            <form-group :form="form" field="height">
                                <input-label for="height">Height: </input-label>
                                <input-text v-model="form.height" id="height" name="height"></input-text>
                            </form-group>
                        </column>

                        <column size="12">
                            <form-group :form="form" field="width">
                                <input-label for="width">Width: </input-label>
                                <input-text v-model="form.width" id="width" name="width"></input-text>
                            </form-group>
                        </column>
                    </column>

                    <column size="12">
                        <form-group :form="form" field="notes">
                            <input-label for="notes">Notes: </input-label>
                            <text-area v-model="form.notes" id="notes" name="notes"></text-area>
                        </form-group>
                    </column>

                    <column size="4">
                        <form-group :form="form" field="reads">
                            <input-label for="reads">Reads: </input-label>
                            <input-text v-model="form.reads" id="reads" name="reads"></input-text>
                        </form-group>
                    </column>

                    <column size="4">
                        <form-group :form="form" field="label">
                            <input-label for="label">Label: </input-label>
                            <input-text v-model="form.label" id="label" name="label"/>
                        </form-group>
                    </column>

                    <column size="4">
                        <form-group :form="form" field="sign_type">
                            <input-label for="sign_type">Sign_Type: </input-label>
                            <input-text v-model="form.sign_type" id="sign_type" name="sign_type"></input-text>
                        </form-group>
                    </column>

                    <column size="4">
                        <form-group :form="form" field="hard_cost">
                            <input-label for="hard_cost">Hard_Cost: </input-label>
                            <input-text v-model="form.hard_cost" id="hard_cost" name="hard_cost"></input-text>
                        </form-group>
                    </column>

                    <column size="4">
                        <form-group :form="form" field="monthly_impressions">
                            <input-label for="monthly_impressions">Monthly_Impressions: </input-label>
                            <input-text v-model="form.monthly_impressions" id="monthly_impressions"
                                        name="monthly_impressions"></input-text>
                        </form-group>
                    </column>

                    <column size="4">
                        <form-group :form="form" field="duration">
                            <input-label for="duration">Duration: </input-label>
                            <input-text v-model="form.duration" id="duration" name="duration"></input-text>
                        </form-group>
                    </column>


                    <column size="12">
                        <form-group :form="form" field="max_ads">
                            <input-label for="max_ads">Max_Ads: </input-label>
                            <input-text v-model="form.max_ads" id="max_ads" name="max_ads"></input-text>
                        </form-group>


                        <form-group :form="form" field="is_iluminated">
                            <input-label for="is_iluminated">Is_Iluminated: </input-label>
                            <toggle-button
                                    :value="form.status"
                                    :sync="true"
                            ></toggle-button>
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
    import BillboardSelect from '../billboard/billboard-select';

    export default {
        mixins: [ModalForm],
        components: {
            BillboardSelect,
        },
        data() {
            return {
                api: 'billboard-face'
            }
        },
        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Add')} BillboardFace`;
            }
        },
        methods: {
            buildForm(billboard_face) {
                return new SlcForm({
                    id: billboard_face ? billboard_face.id : null,
                    unique: billboard_face ? billboard_face.unique : null,
                    unique_id: billboard_face ? billboard_face.unique_id : null,
                    height: billboard_face ? billboard_face.height : null,
                    width: billboard_face ? billboard_face.width : null,
                    reads: billboard_face ? billboard_face.reads : null,
                    label: billboard_face ? billboard_face.label : null,
                    sign_type: billboard_face ? billboard_face.sign_type : null,
                    hard_cost: billboard_face ? billboard_face.hard_cost : null,
                    monthly_impressions: billboard_face ? billboard_face.monthly_impressions : null,
                    notes: billboard_face ? billboard_face.notes : null,
                    max_ads: billboard_face ? billboard_face.max_ads : null,
                    duration: billboard_face ? billboard_face.duration : null,
                    photo: billboard_face ? billboard_face.photo : null,
                    is_iluminated: billboard_face ? billboard_face.is_iluminated : null,
                    billboard: billboard_face ? billboard_face.billboard : null,
                    billboard_id: billboard_face ? billboard_face.billboard_id : null,
                });
            }
        }
    }
</script>