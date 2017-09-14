<template>
    <div>
        <box>
            <box-title>
                Upload Billboards CSV File
            </box-title>
            <box-content>
                <form-submit v-model="form">
                    <row>
                        <column size="8">
                            <h2>Orientations when uploading</h2>
                            <ul>
                                <li>Orientation 1</li>
                                <li>Orientation 2</li>
                                <li>Orientation 3</li>
                            </ul>
                        </column>

                        <column size="4">
                            <form-group :form="form" field="csv">
                                <input-label for="csv">Csv File: </input-label>
                                <input-csv id="csv" v-model="form.csv"></input-csv>
                            </form-group>
                            <btn-submit :disabled="form.busy">
                                <spinner v-if="form.busy"></spinner>
                            </btn-submit>
                        </column>
                    </row>
                </form-submit>
                <row>

                </row>

            </box-content>
        </box>

    </div>
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
        methods: {
            buildForm() {
                return new SlcForm({});
            }
        }
    }
</script>