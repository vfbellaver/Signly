<template>
    <box>
        <box-title>
            {{ title }}
        </box-title>
        <box-content>
        <form-submit v-model="form" @submit="save">
                <row>
                    <column size="6">

                        <row>
                            <column size="5">
                                <form-group :form="form" field="first_name">
                                    <input-label for="first_name">First Name: </input-label>
                                    <input-text v-model="form.first_name" id="first_name" name="first_name"/>
                                </form-group>
                            </column>
                            <column size="7">
                                <form-group :form="form" field="last_name">
                                    <input-label for="last_name">Last Name: </input-label>
                                    <input-text v-model="form.last_name" id="last_name" name="last_name"/>
                                </form-group>
                            </column>
                        </row>

                        <form-group :form="form" field="email">
                            <input-label for="email">Email: </input-label>
                            <input-text v-model="form.email" id="email" name="email"/>
                        </form-group>

                        <row>
                            <column size="4">
                                <form-group :form="form" field="phone1">
                                    <input-label for="phone1">Phone 1: </input-label>
                                    <input-text v-model="form.phone1" id="phone1" name="phone1" type="tel" v-tel/>
                                </form-group>
                            </column>
                            <column size="4">
                                <form-group :form="form" field="phone2">
                                    <input-label for="phone2">Phone 2: </input-label>
                                    <input-text v-model="form.phone2" id="phone2" name="phone2" placeholder="(Optional)" type="tel" v-tel/>
                                </form-group>
                            </column>
                            <column size="4">
                                <form-group :form="form" field="fax">
                                    <input-label for="fax">Fax: </input-label>
                                    <input-text v-model="form.fax" id="fax" name="fax" v-tel/>
                                </form-group>
                            </column>
                        </row>

                        <form-group :form="form" field="address_line1">
                            <input-label for="address_line1">Address Line 1: </input-label>
                            <input-text v-model="form.address_line1" id="address_line1" name="address_line1"/>
                        </form-group>

                        <form-group :form="form" field="address_line2">
                            <input-label for="address_line2">Address Line 2: </input-label>
                            <input-text v-model="form.address_line2" id="address_line2" name="address_line2" placeholder="(Optional)"/>
                        </form-group>

                        <row>
                            <column size="6">
                                <form-group :form="form" field="city">
                                    <input-label for="city">City: </input-label>
                                    <input-text v-model="form.city" id="city" name="city"/>
                                </form-group>
                            </column>
                            <column size="6">
                                <form-group :form="form" field="state">
                                    <input-label for="state">State: </input-label>
                                    <input-text v-model="form.state" id="state" name="state"/>
                                </form-group>
                            </column>
                        </row>
                        <row>
                            <column size="6">
                                <form-group :form="form" field="zipcode">
                                    <input-label for="zipcode">Zipcode: </input-label>
                                    <input-text v-model="form.zipcode" id="zipcode" name="zipcode" v-zipcode/>
                                </form-group>
                            </column>
                            <column size="6">
                                <slot></slot>

                            </column>
                        </row>
                        <btn-submit :disabled="form.busy">
                            <spinner v-if="form.busy"></spinner>
                        </btn-submit>
                    </column>

                    <column size="6">
                        <form-group :form="form" field="company_name">
                            <input-label for="company_name">Company_Name: </input-label>
                            <input-text v-model="form.company_name" id="company_name" name="company_name"/>
                        </form-group>
                        <form-group :form="form" field="logo">
                            <input-label for="logo">Logo: </input-label>
                            <image-upload  id="logo" v-model="form.logo"></image-upload>
                        </form-group>
                    </column>
                </row>
            </modal-footer>
        </form-submit>
        </box-content>
        </box>
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
            save(){
                const uri = laroute.route('api.client.store');
                Slc.post(uri, this.form).then((response) => {
                    console.log('Client Created:',response);
                    this.$emit('saved');
                    window.location = laroute.route("clients.index");
                });
            },
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