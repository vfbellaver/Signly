<template>
    <modal size="lg">
        <modal-header>{{ title }}</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <div class="billboard-face-form">
                    <row>
                        <column size="6">
                            <form-group :form="form" field="photo_url">
                                <input-label for="photo_url">Photo: </input-label>
                                <image-upload v-model="form.photo_url" id="photo_url" name="photo_url"></image-upload>
                            </form-group>
                        </column>
                        <column size="6">
                            <form-group :form="form" field="code">
                                <input-label for="code">ID: </input-label>
                                <input-text :disabled="unique" v-model="form.code" id="code" name="code"></input-text>
                            </form-group>
                            <form-group :form="form" field="label">
                                <input-label for="label">Label: </input-label>
                                <input-text v-model="form.label" id="label" name="label"></input-text>
                            </form-group>
                            <row>
                                <column size="6">
                                    <form-group :form="form" field="height">
                                        <input-label for="height">Height: </input-label>
                                        <input-text v-model="form.height" id="height" name="height"
                                                    placeholder="Optional"></input-text>
                                    </form-group>
                                </column>
                                <column size="6">
                                    <form-group :form="form" field="width">
                                        <input-label for="width">Width: </input-label>
                                        <input-text v-model="form.width" id="width" name="width"
                                                    placeholder="Optional"></input-text>
                                    </form-group>
                                </column>
                            </row>
                            <form-group :form="form" field="type">
                                <input-label for="type">Type: </input-label>
                                <type-select v-model="form.type" name="type" id="type"></type-select>
                            </form-group>
                        </column>
                    </row>

                    <row>
                        <column size="4">
                            <form-group :form="form" field="reads">
                                <input-label for="reads">Reads: </input-label>
                                <read-select v-model="form.reads" id="reads" name="reads"></read-select>
                            </form-group>
                        </column>
                        <column size="4">
                            <form-group :form="form" field="monthly_impressions">
                                <input-label for="monthly_impressions">Monthly Impressions: </input-label>
                                <input-text v-model="form.monthly_impressions" id="monthly_impressions"
                                            name="monthly_impressions" v-integer></input-text>
                            </form-group>
                        </column>
                        <column size="4">
                            <form-group :form="form" field="rate_card">
                                <input-label for="rate_card">Rate Card: </input-label>
                                <input-text v-model="form.rate_card" id="rate_card" name="rate_card"
                                            v-float></input-text>
                            </form-group>
                        </column>
                    </row>

                    <row v-if="form.type === 'Digital'">
                        <column size="4">
                            <form-group :form="form" field="max_ads">
                                <input-label for="max_ads">Max Ads: </input-label>
                                <input-text v-model="form.max_ads" id="max_ads" name="max_ads"
                                            placeholder="Optional"></input-text>
                            </form-group>
                        </column>

                        <column size="4">
                            <form-group :form="form" field="duration">
                                <input-label for="duration">Duration: </input-label>
                                <input-text v-model="form.duration" id="duration" name="duration"
                                            placeholder="Optional"></input-text>
                            </form-group>
                        </column>
                    </row>
                    <row v-else>
                        <column size="4">
                            <form-group :form="form" field="is_illuminated">
                                <input-label for="is_illuminated">Is Illuminated: </input-label>
                                <toggle-button
                                        v-model="form.is_illuminated"
                                        :value="false"
                                        @change="setStatus($event.value, form)"
                                        :sync="true"
                                ></toggle-button>
                            </form-group>
                        </column>

                        <column size="4" v-if="form.is_illuminated">
                            <form-group :form="form" field="lights_on">
                                <input-label for="lights_on">Lights on: </input-label>
                                <vue-timepicker v-model="lights_on" id="lights_on"
                                                format="hh:mm A" name="lights_on"></vue-timepicker>
                            </form-group>
                        </column>

                        <column size="4" v-if="form.is_illuminated">
                            <form-group :form="form" field="lights_off">
                                <input-label for="lights_off">Lights off: </input-label>
                                <vue-timepicker v-model="lights_off" id="lights_off"
                                                format="hh:mm A" name="lights_off"></vue-timepicker>
                            </form-group>
                        </column>
                    </row>

                    <row>
                        <column size="12">
                            <form-group :form="form" field="notes">
                                <input-label for="notes">Notes: </input-label>
                                <text-area v-model="form.notes" id="notes" name="notes"
                                           placeholder="Optional"></text-area>
                            </form-group>
                        </column>
                    </row>
                </div>
            </modal-body>

            <modal-footer>
                <btn-submit :disabled="form.busy">
                    <spinner v-if="form.busy"></spinner>
                </btn-submit>
            </modal-footer>
        </form-submit>
    </modal>
</template>

<style lang="scss">
    .billboard-face-form {
        .image-upload {
            width: 100%;
            height: 264px;
        }

        .time-picker {
            display: block;

            input.display-time {
                background-color: #FFFFFF;
                background-image: none;
                border: 1px solid #e5e6e7;
                border-radius: 1px;
                color: inherit;
                display: block;
                padding: 6px 12px;
                transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
                width: 100%;
                height: auto;

                &:focus {
                    border-color: #43A3D0;
                }
            }
        }

    }
</style>

<script>

    import _ from 'lodash';
    import * as Slc from "../../vue/http";
    import ModalForm from '../shared/Mixins/ModalForm';
    import VueTimepicker from "../../../../../node_modules/vue2-timepicker/src/vue-timepicker";
    import TypeSelect from "./type-select";
    import ReadSelect from "./read-select.vue";

    export default {

        components: {
            VueTimepicker,
            TypeSelect,
            ReadSelect,
        },
        props: {
            billboardId: {required: true},
        },

        mixins: [ModalForm],

        data() {
            return {
                api: 'billboard-face',
                loaded: false,
                lights_on: {
                    hh: null,
                    mm: null,
                    A: null
                },

                lights_off: {
                    hh: null,
                    mm: null,
                    A: null
                },
            }
        },

        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Add')} Billboard Face`;
            },

            unique() {
                return !!this.form.id;
            },
        },

        mounted() {
            this.form.is_illuminated = false;
        },

        watch: {
            lights_on: {
                handler(value) {
                    if (value.hh && value.mm && value.A) {
                        const m = moment(`${value.hh}:${value.mm}:${value.A}`, "hh:mm A");
                        this.form.lights_on = m.format('HH:mm:ss');
                    }
                },
                deep: true,
            },
            lights_off: {
                handler(value) {
                    if (value.hh && value.mm && value.A) {
                        const m = moment(`${value.hh}:${value.mm}:${value.A}`, "hh:mm A");
                        this.form.lights_off = m.format('HH:mm:ss');
                    }
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
                    rate_card: billboard_face ? billboard_face.rate_card : null,
                    monthly_impressions: billboard_face ? billboard_face.monthly_impressions : null,
                    notes: billboard_face ? billboard_face.notes : null,
                    max_ads: billboard_face ? billboard_face.max_ads : null,
                    duration: billboard_face ? billboard_face.duration : null,
                    photo_url: billboard_face ? billboard_face.photo_url : null,
                    is_illuminated: billboard_face ? billboard_face.is_illuminated : false,
                    lights_on: billboard_face ? billboard_face.lights_on : null,
                    lights_off: billboard_face ? billboard_face.lights_off : null,
                    type: billboard_face ? billboard_face.type : 'Static',
                    billboard_face: billboard_face ? billboard_face.id : null,
                    billboard: this.billboardId,
                };

                if (data.lights_on) {
                    const m = moment(data.lights_on, "HH:mm:ss");
                    this.lights_on = {
                        hh: m.format('hh'),
                        mm: m.format('mm'),
                        A: m.format('A'),
                    };
                }

                if (data.lights_off) {
                    const m = moment(data.lights_off, "HH:mm:ss");
                    this.lights_off = {
                        hh: m.format('hh'),
                        mm: m.format('mm'),
                        A: m.format('A'),
                    };
                }
                this.loaded = true;
                return new SlcForm(data);
            },
            setStatus(value, item) {
                item.is_illuminated = value;
                if (!value) {
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