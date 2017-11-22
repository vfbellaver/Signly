<template>
    <modal size="lg">
        <modal-header>Import Clients</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="6">
                        <form-group :form="form" field="filecsv">
                            <input-label for="filecsv">Select File: </input-label>
                            <client-csv-upload v-model="form.clients" id="clients" @uploaded="updateUploaded"></client-csv-upload>
                        </form-group>
                    </column>
                    <column size="6">
                        <form-group :form="form" field="template">
                            <input-label for="template">Download the import template file:</input-label>
                            <br/>
                            <a href="/misc/clients.csv">
                                <box-tool icon="download">Download</box-tool>
                            </a>
                        </form-group>
                    </column>
                </row>
                <form-group :form="form" field="tablebillboards">
                    <div style="overflow: auto; max-height: 400px">
                        <table v-if="form.clients" class="table table-responsive table-striped">
                            <thead>
                            <tr>
                                <th style="width: 50px"></th>
                                <th style="width: 300px">Company Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( client,index ) in form.clients">
                                <td>{{ index + 1 }}</td>
                                <td>{{ client.company_name }}</td>
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
<style lang="scss" scoped="scoped">

</style>
<script>
    import * as Slc from "../../vue/http";
    import ModalForm from '../shared/Mixins/ModalForm';
    import ClientCsvUpload from './client-csv-upload'

    export default {
        props: {},
        components: {
            ClientCsvUpload,
        },
        mixins: [ModalForm],
        data() {
            return {
                uploaded: false,
            }
        },

        methods: {
            buildForm() {
                return new SlcForm({
                    clients: []
                });
            },
            save() {
                const uri = laroute.route('api.client.import');
                Slc.post(uri, this.form).then((response) => {
                    console.log('Post Billboards:', response);
                    this.saved(response.data, 'saved');
                });

            },
            updateUploaded(){
                this.uploaded = true;
            },

        }
    }
</script>
