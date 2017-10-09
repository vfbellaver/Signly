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
                <billboard-card :key="billboard.id" billboard="billboard"
                                v-for="billboard in billboards"></billboard-card>
            </box-content>
        </box>
        <billboard-import-form @saved="reload" ref="formCsv"></billboard-import-form>
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

    import BillboardCard from './billboard-card';
    import BillboardImportForm from './billboard-import-form';

    export default {
        components: {
            BillboardCard,
            BillboardImportForm,
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