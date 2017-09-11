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
                        <form-group :form="form" field="address">
                            <input-label for="address">Address: </input-label>
                            <input-text v-model="form.address" id="address" name="address"/>
                        </form-group>     
                        <form-group :form="form" field="lat">
                            <input-label for="lat">Lat: </input-label>
                            <input-text v-model="form.lat" id="lat" name="lat"/>
                        </form-group>     
                        <form-group :form="form" field="lng">
                            <input-label for="lng">Lng: </input-label>
                            <input-text v-model="form.lng" id="lng" name="lng"/>
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
					address: billboard ? billboard.address : null,
					lat: billboard ? billboard.lat : null,
					lng: billboard ? billboard.lng : null,
                });
            }
        }
    }
</script>