<template>
    <div>
        <box>
            <box-title>
                Billboards
                <box-tools slot="tools">
                    <box-tool icon="plus" @click.native="create">New</box-tool>
                    <box-tool icon="upload" @click.native="importBillboards">Import Billboards</box-tool>
                    <box-tool class="green" icon="map-marker" @click.native="goToHome">Map View</box-tool>
                </box-tools>
            </box-title>
            <box-content>
                <div>
                    <div class="table-responsive">
                        <!--table-->
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 50px"></th>
                                <th style="width: 300px">Name</th>
                                <th style="width: 600px" class="hidden-sm">Address</th>
                                <th style="width:  100px"></th>
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
                </div>
            </box-content>
        </box>
        <billboard-form-csv @saved="reload" ref="formCsv"></billboard-form-csv>
    </div>
</template>

<style lang="scss" scoped="scoped">
    .green:hover {
        color: #7aa32b;
    }
</style>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";
    import BillboardFormCsv from './billboard-form-csv.vue'

    export default {
        components: {
            BillboardFormCsv
        },
        data() {
            return {
                billboards: [],
            }
        },
        mounted() {
            this.reload();
        },
        methods: {
            create() {
                window.location = laroute.route('billboards.create');
            },
            edit(billboard) {
                window.location = laroute.route("billboards.edit", {billboard: billboard.id});
            },
            importBillboards() {
                this.$refs.formCsv.show();
            },
            goToHome() {
                window.location = "/";
            },
            reload() {
                Slc.get(laroute.route('api.billboard.index'))
                    .then((response) => {
                        this.billboards = response;
                    });
            },
            destroy(billboard) {
                Slc.delete(laroute.route('api.billboard.destroy', {billboard: billboard.id}), billboard.destroyForm)
                    .then(() => {
                        this.removeBillboard(billboard);
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