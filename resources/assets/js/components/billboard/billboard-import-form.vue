<template>
    <modal size="lg">
        <modal-header>Import Billboards</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="6">
                        <form-group :form="form" field="filecsv">
                            <input-label for="filecsv">Select File: </input-label>
                            <billboard-csv-upload v-model="form.billboards" id="billboards"></billboard-csv-upload>
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
                                    <li v-for="face in billboard.faces">{{face.code}} - {{face.code}}</li>
                                </ul>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form-group>
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
    import * as Slc from "../../vue/http";
    import ModalForm from '../shared/Mixins/ModalForm';
    import BillboardCsvUpload from './billboard-csv-upload';

    export default {
        props: {},
        components: {
            BillboardCsvUpload,
        },
        mixins: [ModalForm],
        data() {
            return {
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

            save() {
                const uri = laroute.route('api.billboard.import');
                Slc.post(uri, this.form).then((response) => {
                    console.log('Post Billboards:', response);
                    this.saved(response.data, 'saved');
                });

            }

        }
    }
</script>
