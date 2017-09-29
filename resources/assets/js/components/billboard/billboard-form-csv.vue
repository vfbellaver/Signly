<template>
    <modal>
        <modal-header>Import Billboards</modal-header>
            <form-submit v-model="form" @submit="save">
                <modal-body>
                    <form-group :form="form" field="filecsv">
                        <input-label for="filecsv">Select File: </input-label>
                        <input-csv  v-model="form.billboards" id="billboards"></input-csv>
                    </form-group>

                    <form-group :form="form" field="tablebillboards">
                        <table  v-if="form.billboards" class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 50px"></th>
                                    <th style="width: 300px">Name</th>
                                    <th style="width: 600px" class="hidden-sm">Address</th>
                                    <th>Driveby</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="( billboard,index ) in form.billboards">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ billboard.name }}</td>
                                    <td class="hidden-sm">{{ billboard.address }}</td>
                                    <td>{{ billboard.digital_driveby }}</td>
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


    export default{
        mixins: [ModalForm],
        props: {},
        data() {
            return {
                api: 'csv',
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

            save(){
                const uri = laroute.route('api.csv.store');
                Slc.post(uri,this.form).then((response)=> {
                    console.log('Post Billboards:',response);
                    this.saved(response.data,'saved');
                });

            }

        }
    }
</script>
