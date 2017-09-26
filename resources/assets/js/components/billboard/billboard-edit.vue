<template>
    <form-submit v-model="form" @submit="save">
        <row>
            <column size="12">
                <form-group :form="form" field="name">
                    <input-label for="name">Name: </input-label>
                    <input-text v-model="form.name" id="name" name="name"></input-text>
                </form-group>

                <form-group :form="form" field="description">
                    <input-label for="description">Description: </input-label>
                    <text-area v-model="form.description" id="description" name="description"></text-area>
                </form-group>

                <form-group :form="form" field="address">
                    <input-label for="address">Address: </input-label>
                    <input-text v-model="form.address" id="address" name="address"></input-text>
                </form-group>
            </column>

            <column size="6">
                <form-group :form="form" field="lat">
                    <input-label for="lat">Latitude: </input-label>
                    <input-text v-model="form.lat" id="lat" name="lat"></input-text>
                </form-group>
            </column>

            <column size="6">
                <form-group :form="form" field="lng">
                    <input-label for="lng">Longitude: </input-label>
                    <input-text v-model="form.lng" id="lng" name="lng"></input-text>
                </form-group>
            </column>

            <column size="12">
                <form-group :form="form" field="digital_driveby">
                    <input-label for="digital_driveby">Digital Driveby: </input-label>
                    <input-text v-model="form.digital_driveby" id="digital_driveby" name="digital_driveby"></input-text>
                </form-group>
            </column>

            <column size="12">
                <form-group :form="form" field="digital_driveby">
                    <input-label for="digital_driveby">Billboard Faces: </input-label>
                    <billboard-face-list :billboard-id="id"></billboard-face-list>
                </form-group>
            </column>
        </row>
    </form-submit>
</template>

<script>

    import * as Slc from "../../vue/http";

    export default {

        props: {
            id: {required: true}
        },

        data() {
            return {
                form: new SlcForm({}),
                loading: false,
            }
        },

        created() {
            const self = this;
            this.load();
        },

        methods: {

            load() {
                this.loading = true;

                const uri = laroute.route('api.billboard.show', {billboard: this.id});

                Slc.find(uri).then((billboard) => {
                    console.log(billboard);
                    this.loading = false;
                    this.form = new SlcForm({
                        id: billboard.id,
                        name: billboard.name,
                        description: billboard.description,
                        digital_driveby: billboard.digital_driveby,
                        address: billboard.address,
                        lat: billboard.lat,
                        lng: billboard.lng,
                    });
                });
            },
            save() {

            }
        }
    }
</script>
