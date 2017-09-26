<template>

        <box>
            <column size="12">
            <box-title>
                Import Billboards File Csv
            </box-title>
            <box-content>
                <form-submit v-model="form" @submit="save">
                    <row>
                    <column size="3">
                        <form-group :form="form" field="filecsv">
                            <input-label for="filecsv">Select File: </input-label>
                            <input-csv  v-model="form.filecsv" id="filecsv"></input-csv>
                        </form-group>

                        <btn-submit :disabled="form.busy">
                            <spinner v-if="form.busy"></spinner>
                        </btn-submit>
                    </column>
                    <column size="9">

                    </column>
                    </row>

                </form-submit>
            </box-content>
            </column>
        </box>
    </div>

</template>
<script>
    import * as Slc from "../../vue/http";
    import ModalForm from '../shared/Mixins/ModalForm';

    export default{
        mixins: [ModalForm],
        props: {},
        data() {
            return {
                api: 'billboardcsv'
            }
        },

        methods: {
            buildForm(billboard) {
                this.filecsv = null;


                return new SlcForm({
                    filecsv: billboard ? billboard.filecsv : null,

                });
            },

            submitImport(){

            }
        }
    }
</script>
