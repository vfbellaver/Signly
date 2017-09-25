<template>
    <div>
        <box>
            <column size="12">
            <box-title>
                Import Billboards File Csv
            </box-title>
            <box-content>
                <form-submit v-model="form">
                    <row>
                    <column size="6">
                        <h2>Instructions Upload</h2>

                        <ul>
                            <li>Inst 1</li>
                            <li>Inst 2</li>
                            <li>Inst 3</li>
                        </ul>
                    </column>
                    <column size="3">
                        <div class="form-group">
                            <label> Select file:</label>
                            <input-csv id="csv" v-model="csv"></input-csv>
                        </div>
                        <div class="form-group">
                            <button  type="submit" class="btn btn-primary" v-on:click="submitImport">
                                <i class="fa fa-upload"></i> Upload
                            </button>
                        </div>
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
        data() {
            return {
                internalAllowedTypes: [],
                files: []
            }
        },

        methods: {
            buildForm(){

            },

            submitImport(){

            }
        }
    }
</script>
