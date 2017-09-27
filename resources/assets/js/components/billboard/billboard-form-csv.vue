<template>

        <box>
            <column size="12">
            <box-title>
                Import Billboards File Csv
            </box-title>
            <box-content>
                <form-submit v-model="form" @submit="save">

                        <form-group :form="form" field="filecsv">
                            <input-label for="filecsv">Select File: </input-label>
                            <input-csv  v-model="form.csv" id="filecsv"></input-csv>
                        </form-group>
                    <box-title>
                        <column size="12" >
                            <btn-submit :disabled="form.busy">Save Billboards
                                <spinner v-if="form.busy"></spinner>
                            </btn-submit>
                        </column>
                    </box-title>
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
                api: 'billboardcsv',
            }
        },


        methods: {
            buildForm(billboardcsv) {
                return new SlcForm({
                    csv: billboardcsv ? billboardcsv.csv : null,

                });
            },

            save(){

             }
        }
    }
</script>
