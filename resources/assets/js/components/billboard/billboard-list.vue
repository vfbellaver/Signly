<template>
    <div>
        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>

        <nav class="navbar navbar-in-content navbar-default" data-spy="affix" data-offset-top="147">
            <ul class="nav navbar-nav">
                <li>
                    <a @click="view = 'list'"  title="List Face View">
                        <icon icon="list"></icon>
                        List View
                    </a>
                </li>
                <li>
                    <a @click="view = 'card'"  title="Card View Grouped by Address">
                        <icon icon="address-card"></icon>
                        Card View
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a @click="create">
                        <icon icon="plus"></icon>
                        Add
                    </a>
                </li>
                <li>
                    <a @click="importBillboards">
                        <icon icon="upload"></icon>
                        Import
                    </a>
                </li>
                <li>
                    <a @click="goToHome">
                        <icon icon="map-marker"></icon>
                        Map
                    </a>
                </li>
            </ul>
        </nav>

        <div class="wrapper wrapper-content card-list">
            <div class="container-fluid">
                <div class="row" v-if="view === 'card'">
                    <div class="col-md-4" v-for="billboard in billboards">
                        <billboard-card :billboard="billboard" @edit="edit" @destroy="destroy"
                                        :team="team"></billboard-card>
                    </div>
                </div>
                <div class="row" v-else>
                    <billboard-list-view :list="billboards"></billboard-list-view>
                </div>
            </div>
        </div>
        <billboard-form ref="form" @saved="edit"></billboard-form>
        <billboard-import-form ref="importForm" @saved="reload"></billboard-import-form>
    </div>
</template>

<style lang="scss" scoped="scoped">
</style>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";
    import BillboardCard from './list/billboard-card';
    import BillboardForm from './list/billboard-form';
    import BillboardImportForm from './list/billboard-import-form';
    import BillboardListView from './billboard-list-view';
    export default {
        props: {
            team: {required: true},
        },
        components: {
            BillboardCard,
            BillboardForm,
            BillboardImportForm,
            BillboardListView
        },
        data: () => ({
            billboards: [],
            view: 'list',
            pageHeading: {
                title: 'Billboard List',
                breadcrumb:
                    [
                        {title: 'Home', url: laroute.route('home')}
                    ]
            },
        }),
        mounted() {
            this.reload();
        },
        methods: {
            create() {
                this.$refs.form.show();
            },
            edit(billboard) {
                window.location = laroute.route("billboards.edit", {billboard: billboard.id});
            },
            importBillboards() {
                this.$refs.importForm.show();
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
            },
        }
    }
</script>