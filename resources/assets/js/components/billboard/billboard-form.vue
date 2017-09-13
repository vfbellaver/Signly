<template>
    <modal>
        <modal-header>{{ title }}</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="12">

                        <form-group :form="form" field="name">
                            <input-label for="name">Name: </input-label>
                            <input-text v-model="form.name" id="name" name="name"/>
                        </form-group>     

                        <form-group :form="form" field="description">
                            <input-label for="description">Description: </input-label>
                            <text-area v-model="form.description" id="description" name="description"/>
                        </form-group>     

                        <form-group :form="form" field="address">
                            <input-label for="address">Address: </input-label>
                            <input-text v-model="form.address" id="address" name="address"/>
                        </form-group>

                    </column>

                    <!--Google map-->
                    <column size="12">
                        <div id="map"></div>
                    </column>

                    <column size="12">

                        <form-group :form="form" field="lat">
                            <input-label for="lat">Latitude: </input-label>
                            <input-text v-model="form.lat" id="lat" name="lat"/>
                        </form-group>     

                        <form-group :form="form" field="lng">
                            <input-label for="lng">Longitude: </input-label>
                            <input-text v-model="form.lng" id="lng" name="lng"/>
                        </form-group>

                        <form-group :form="form" field="digital_driveby">
                            <input-label for="digital_driveby">Digital Driveby: </input-label>
                            <input-text v-model="form.digital_driveby" id="digital_driveby" name="digital_driveby"/>
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
                api: 'billboard'
            }
        },
        computed: {
            title() {
                return `${(this.form.id ? 'Edit' : 'Add')} Billboard`;
            }
        },
        methods: {
            buildForm(billboard) {
                return new SlcForm({
					id: billboard ? billboard.id : null,
					name: billboard ? billboard.name : null,
					description: billboard ? billboard.description : null,
					digital_driveby: billboard ? billboard.digital_driveby : null,
					address: billboard ? billboard.address : null,
					lat: billboard ? billboard.lat : null,
					lng: billboard ? billboard.lng : null,
                });
            }
        }
    }
</script>
