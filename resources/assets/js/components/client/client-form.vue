<template>
    <modal size="lg">
        <modal-header>{{title}}</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="8">
                        <form-group :form="form" field="company_name">
                            <input-label for="company_name">Company Name: </input-label>
                            <input-text v-model="form.company_name" id="company_name" name="company_name"></input-text>
                        </form-group>

                        <row>
                            <column size="6">
                                <form-group :form="form" field="first_name">
                                    <input-label for="first_name">First Name: </input-label>
                                    <input-text v-model="form.first_name" id="first_name"
                                                name="first_name"></input-text>
                                </form-group>
                            </column>

                            <column size="6">
                                <form-group :form="form" field="last_name">
                                    <input-label for="last_name">Last Name: </input-label>
                                    <input-text v-model="form.last_name" id="last_name" name="last_name"></input-text>
                                </form-group>
                            </column>
                        </row>

                        <form-group :form="form" field="email">
                            <input-label for="email">Email: </input-label>
                            <input-text v-model="form.email" id="email" name="email"></input-text>
                        </form-group>

                        <row>
                            <column size="4">
                                <form-group :form="form" field="phone1">
                                    <input-label for="phone1">Phone 1: </input-label>
                                    <input-text v-model="form.phone1" id="phone1" name="phone1" type="tel"
                                                v-tel></input-text>
                                </form-group>
                            </column>

                            <column size="4">
                                <form-group :form="form" field="phone2">
                                    <input-label for="phone2">Phone 2: </input-label>
                                    <input-text v-model="form.phone2" id="phone2" name="phone2" placeholder="(Optional)"
                                                type="tel" v-tel></input-text>
                                </form-group>
                            </column>

                            <column size="4">
                                <form-group :form="form" field="fax">
                                    <input-label for="fax">Fax: </input-label>
                                    <input-text v-model="form.fax" id="fax" name="fax" v-tel></input-text>
                                </form-group>
                            </column>
                        </row>

                        <form-group :form="form" field="address_line1">
                            <input-label for="address_line1">Address Line 1: </input-label>
                            <input-text v-model="form.address_line1" id="address_line1"
                                        name="address_line1"></input-text>
                        </form-group>

                        <form-group :form="form" field="address_line2">
                            <input-label for="address_line2">Address Line 2: </input-label>
                            <input-text v-model="form.address_line2" id="address_line2" name="address_line2"
                                        placeholder="(Optional)"></input-text>
                        </form-group>

                        <form-group :form="form" field="city">
                            <input-label for="city">City: </input-label>
                            <input-text v-model="form.city" id="city" name="city"></input-text>
                        </form-group>

                        <form-group :form="form" field="state">
                            <input-label for="state">State: </input-label>
                            <input-text v-model="form.state" id="state" name="state"></input-text>
                        </form-group>

                        <form-group :form="form" field="zipcode">
                            <input-label for="zipcode">Zipcode: </input-label>
                            <input-text v-model="form.zipcode" id="zipcode" name="zipcode"
                                        v-zipcode></input-text>
                        </form-group>

                    </column>

                    <column size="4">
                        <form-group :form="form" field="logo">
                            <input-label for="logo">Logo: </input-label>
                            <image-upload id="logo" v-model="form.logo"></image-upload>
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
<style lang="scss" scoped="scoped">
    .image-upload {
        max-height: 50px;
    }
</style>
<script>
    import ModalForm from '../shared/Mixins/ModalForm';

    export default {
        mixins: [ModalForm],
        props: {},
        data() {
            return {
                api: 'client'
            }
        },
        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Add')} Client`;
            }
        },
        methods: {
            buildForm(client) {
                return new SlcForm({
                    id: client ? client.id : null,
                    company_name: client ? client.company_name : null,
                    logo: client ? client.logo : null,
                    first_name: client ? client.first_name : null,
                    last_name: client ? client.last_name : null,
                    email: client ? client.email : null,
                    address_line1: client ? client.address_line1 : null,
                    address_line2: client ? client.address_line2 : null,
                    city: client ? client.city : null,
                    zipcode: client ? client.zipcode : null,
                    state: client ? client.state : null,
                    phone1: client ? client.phone1 : null,
                    phone2: client ? client.phone2 : null,
                    fax: client ? client.fax : null,
                });
            }
        }
    }
</script>