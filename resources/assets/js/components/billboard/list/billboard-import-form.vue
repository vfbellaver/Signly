<template>
    <modal size="lg">
        <modal-header>Import Billboards</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="6">
                        <form-group :form="form" field="filecsv">
                            <input-label for="filecsv">Select File: </input-label>
                            <billboard-csv-upload v-model="form.billboards" id="billboards"
                                                  @uploading="updateUploaded"></billboard-csv-upload>
                        </form-group>
                    </column>
                    <column size="6">
                        <form-group :form="form" field="template">
                            <input-label for="template">Download the import template file:</input-label>
                            <br/>
                            <a href="/misc/billboards.csv">
                                <box-tool icon="download">Download</box-tool>
                            </a>
                        </form-group>
                    </column>
                </row>

                <form-group :form="form" field="tablebillboards">
                    <div style="overflow: auto; max-height: 400px">
                        <table v-if="form.billboards" class="table table-responsive table-striped">
                            <thead>
                            <tr>
                                <th style="width: 50px"></th>
                                <th style="width: 300px">Name</th>
                                <th>Faces</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( billboard,index ) in form.billboards">
                                <td>{{ index + 1 }}</td>
                                <td>{{ billboard.name }}</td>
                                <td>
                                    <ul>
                                        <li v-for="face in billboard.faces">
                                            {{face.id}} - {{face.label}} {{face.type}}
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form-group>
            </modal-body>

            <modal-footer>
                <btn-submit :disabled="!uploaded">
                    <spinner v-if="form.busy"></spinner>
                </btn-submit>
            </modal-footer>
        </form-submit>
    </modal>
</template>
<script>
    import * as Slc from "../../../vue/http";
    import ModalForm from '../../shared/Mixins/ModalForm';
    import BillboardCsvUpload from './billboard-csv-upload';

    export default {
        props     : {},
        components: {
            BillboardCsvUpload,
        },
        mixins    : [ModalForm],
        data() {
            return {
                uploaded: false,
            }
        },

        methods: {
            buildForm() {
                return new SlcForm({
                    billboards: []
                });
            },
            reload() {
                window.location = laroute.route("billboards.index");
            },
            updateUploaded() {
                this.uploaded = true;
            },


            save() {
                const uri = laroute.route('api.billboard.import');
                Slc.post(uri, this.form)
                    .then((response) => {
                        console.log('Post Billboards:', response);
                        window.location = laroute.route("billboards.index");
                    });
            }
        }
    }
</script>
