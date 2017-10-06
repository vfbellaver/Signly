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
                            <form-group :form="form" field="code">
                                <input-label for="code">Code: </input-label>
                                <input-text :disabled="unique" v-model="form.code" id="code" name="code"></input-text>
                            </form-group>
                        </column>

                        <column size="12">
                            <form-group :form="form" field="height">
                                <input-label for="height">Height: </input-label>
                                <input-text v-model="form.height" id="height" name="height" placeholder="Optional"></input-text>
                            </form-group>
                        </column>

                        <column size="12">
                            <form-group :form="form" field="width">
                                <input-label for="width">Width: </input-label>
                                <input-text v-model="form.width" id="width" name="width" placeholder="Optional"></input-text>
                            </form-group>
                        </column>
                    </column>

                    <column size="12">
                        <form-group :form="form" field="notes">
                            <input-label for="notes">Notes: </input-label>
                            <text-area v-model="form.notes" id="notes" name="notes" placeholder="Optional"></text-area>
                        </form-group>
                    </column>

                    <column size="4">
                        <form-group :form="form" field="reads">
                            <input-label for="reads">Reads: </input-label>
                            <input-text v-model="form.reads" id="reads" name="reads" placeholder="Optional"></input-text>
                        </form-group>
                    </column>

                    <column size="4">
                        <form-group :form="form" field="label">
                            <input-label for="label">Label: </input-label>
                            <input-text v-model="form.label" id="label" name="label"/>
                        </form-group>
                    </column>


                    <column size="4">
                        <form-group :form="form" field="hard_cost">
                            <input-label for="hard_cost">Hard Cost: </input-label>
                            <input-text v-model="form.hard_cost" id="hard_cost" name="hard_cost" v-float></input-text>
                        </form-group>
                    </column>

                    <column size="4">
                        <form-group :form="form" field="monthly_impressions">
                            <input-label for="monthly_impressions">Monthly Impressions: </input-label>
                            <input-text v-model="form.monthly_impressions" id="monthly_impressions"
                                        name="monthly_impressions"></input-text>
                        </form-group>
                    </column>

                    <column size="8">
                        <form-group :form="form" field="duration">
                            <input-label for="duration">Duration: </input-label>
                            <input-text v-model="form.duration" id="duration" name="duration"></input-text>
                        </form-group>
                    </column>


                    <column size="12">
                        <form-group :form="form" field="max_ads">
                            <input-label for="max_ads">Max Ads: </input-label>
                            <input-text v-model="form.max_ads" id="max_ads" name="max_ads" placeholder="Optional"></input-text>
                        </form-group>
                    </column>
                    <column size="12">
                        <row>
                            <column size="4">
                                <form-group :form="form" field="is_iluminated">
                                    <input-label for="is_iluminated">Is Illuminated: </input-label>
                                    <toggle-button
                                            v-model="form.is_iluminated"
                                            :value="false"
                                            @change="setStatus($event.value, form)"
                                            :sync="true"
                                    ></toggle-button>
                                </form-group>
                            </column>

                            <column size="4">
                                <form-group :form="form" field="lights_on">
                                    <input-label for="lights_on">Lights on: </input-label>
                                    <vue-timepicker v-model="lights_on" id="lights_on"
                                                    name="lights_on"></vue-timepicker>
                                </form-group>
                            </column>

                            <column size="4">
                                <form-group :form="form" field="lights_off">
                                    <input-label for="lights_off">Lights off: </input-label>
                                    <vue-timepicker v-model="lights_off" id="lights_off" name="lights_off"></vue-timepicker>
                                </form-group>
                             </column>
                        </row>
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
    import VueTimepicker from "../../../../../node_modules/vue2-timepicker/src/vue-timepicker";

    export default {

        components: {VueTimepicker},
        props: {
            billboardId: {required: true},
        },

        mixins: [ModalForm],


        data() {
            return {
                api: 'billboard-face',
                lights_on: {
                    HH: null,
                    mm: null,
                    ss: null,
                },

                lights_off: {
                    HH: null,
                    mm: null,
                    ss: null,
                },
            }
        },

        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Add')} BillboardFace`;
            },

            unique() {
               return this.form.id ? true : false;
            },
        },

        mounted() {
          this.form.is_iluminated = false;
        },

        watch: {
            lights_on: {
                handler(value){
                    if(value.HH && value.mm){
                        this.form.lights_on = value.HH+':'+value.mm+':'+value.ss;
                    }
                    return;
                },
                deep: true,
            },
            lights_off: {
                handler(value){
                    if(value.HH && value.mm){
                        this.form.lights_off = value.HH+':'+value.mm+':'+value.ss;
                    }
                    return;
                },
                deep: true,
            },
        },

        methods: {
            buildForm(billboard_face) {
                const data = {
                    id: billboard_face ? billboard_face.id : null,
                    code: billboard_face ? billboard_face.code : null,
                    height: billboard_face ? billboard_face.height : null,
                    width: billboard_face ? billboard_face.width : null,
                    reads: billboard_face ? billboard_face.reads : null,
                    label: billboard_face ? billboard_face.label : null,
                    hard_cost: billboard_face ? billboard_face.hard_cost : null,
                    monthly_impressions: billboard_face ? billboard_face.monthly_impressions : null,
                    notes: billboard_face ? billboard_face.notes : null,
                    max_ads: billboard_face ? billboard_face.max_ads : null,
                    duration: billboard_face ? billboard_face.duration : null,
                    photo: billboard_face ? billboard_face.photo : null,
                    is_iluminated: billboard_face ? billboard_face.is_iluminated : false,
                    lights_on: billboard_face ? billboard_face.lights_on : null,
                    lights_off: billboard_face ? billboard_face.lights_off : null,
                    billboard_face: billboard_face ? billboard_face.id : null,
                    billboard: this.billboardId,
                };
                this.setHoras(data);
                return new SlcForm(data);
            },
            setHoras(data){
                if(data.lights_on && data.lights_off){
                    let light_on = data.lights_on.split(":");
                    let light_off = data.lights_off.split(":");

                    this.lights_on = {
                        HH: light_on[0],
                        mm: light_on[1],
                        ss: light_on[2],
                    };
                    this.lights_off = {
                        HH: light_off[0],
                        mm: light_off[1],
                        ss: light_off[2],
                    }
                }
            },
            setStatus(value, item) {
                item.is_iluminated = value;
                if(!value){
                    this.form.lights_on = null;
                    this.form.lights_off = null;
                    this.lights_on = {
                        HH: null,
                        mm: null,
                        ss: null,
                    };
                    this.lights_off = {
                        HH: null,
                        mm: null,
                        ss: null,
                    };
                }
            }
        },

    }

</script>