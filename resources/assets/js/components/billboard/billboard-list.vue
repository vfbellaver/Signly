<template>
    <div>
        <box>
            <box-title>
                Billboards
                <box-tools slot="tools">
                    <box-tool icon="plus" @click.native="add">New</box-tool>
                    <box-tool icon="upload" @click.native="importBillboards">Import Billboards</box-tool>
                </box-tools>
            </box-title>
            <box-content>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="width: 50px"></th>
                            <th style="width: 300px">Name</th>
                            <th style="width: 600px" class="hidden-sm">Address</th>
                            <th style="width: 100px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="( billboard, index ) in billboards">
                            <td>{{ index + 1 }}</td>
                            <td>{{ billboard.name }}</td>
                            <td class="hidden-sm">{{ billboard.address }}</td>
                            <td>
                                <btn-success size="xs" @click.native="edit(billboard)">
                                    <icon icon="edit"></icon>
                                </btn-success>
                                <btn-danger @click.native="destroy(billboard)"
                                            :disabled="billboard.destroyForm.busy"
                                            size="xs">
                                    <spinner v-if="billboard.destroyForm.busy"></spinner>
                                    <icon icon="trash" v-else></icon>
                                </btn-danger>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </box-content>
        </box>

        <billboard-form-csv @saved="reload" ref="formcsv"></billboard-form-csv>
    </div>
</template>

<script>
    import BillboardFormCsv from './billboard-form-csv.vue'


    export default {
        components: {
            BillboardFormCsv
        },
        data() {
            return {
                billboards: []
            }
        },

        mounted() {
            this.reload();
        },

        methods: {

            add() {
                window.location = laroute.route("billboards.create");
            },
            importBillboards(){
                this.$refs.formcsv.show();
            },


            edit(billboard) {
                window.location = laroute.route("billboards.edit", {billboard: billboard.id});
            },

            reload() {
                let self = this;
                Slc.get(laroute.route('api.billboard.index'))
                    .then((response) => {
                        self.billboards = response;
                    });
            },


            destroy(billboard) {
                let self = this;
                Slc.delete(laroute.route('api.billboard.destroy', {billboard: billboard.id}), billboard.destroyForm)
                    .then(() => {
                        self.removeBillboard(billboard);
                    });
            },

            removeBillboard(billboard) {
                this.billboards.splice(this.findIndex(billboard), 1);
            },

            findIndex(billboard) {
                return this.billboards.findIndex((_billboard) => {
                    return _billboard.id === billboard.id;
                });
            }
        }

    }

</script>