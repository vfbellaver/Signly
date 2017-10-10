<template>
    <div class="card-list">

        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>

        <nav class="navbar navbar-in-content navbar-default" data-spy="affix" data-offset-top="147">
            <ul class="nav navbar-nav navbar-right">
                <li><a @click="create">
                    <icon icon="plus"></icon>
                    Add</a></li>
                <li><a @click="importBillboards">
                    <icon icon="upload"></icon>
                    Import</a></li>
                <li><a @click="goToHome">
                    <icon icon="map-marker"></icon>
                    Map</a></li>
            </ul>
        </nav>

        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4" v-for="billboard in billboards">
                        <billboard-card :billboard="billboard" @edit="edit" @destroy="destroy"></billboard-card>
                    </div>
                </div>
            </div>
        </div>
        <billboard-form ref="form" @saved="edit"></billboard-form>
        <billboard-import-form ref="importForm" @saved="reload"></billboard-import-form>
    </div>
</template>

<style lang="scss" scoped="scoped">
    .card-list {
        .navbar-in-content {
            z-index: 1;
            opacity: 0.9;
            border-radius: 0;
            background: #43A3D0;
            position: absolute;
            left: 0;
            right: 0;
            min-height: 30px;
            li {
                a {
                    color: white;
                    padding: 5px 20px;
                    &:hover {
                        background: transparent;
                    }
                }
            }
            &.affix {
                position: fixed;
                top: 0;
                width: 100%;
            }
        }
    }

    .results {
        .ibox {
            margin-top: 0;
        }
    }
</style>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";

    import BillboardCard from './billboard-card';
    import BillboardForm from './billboard-form';
    import BillboardImportForm from './billboard-import-form';

    export default {
        components: {
            BillboardCard,
            BillboardForm,
            BillboardImportForm,
        },
        data() {
            return {
                billboards: [],
                pageHeading: {
                    title: 'Billboard List',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')}
                    ]
                },
            }
        },
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
            }
        }
    }
</script>