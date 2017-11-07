<template>
    <div class="map-controls">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="file-manager">
                    <h5>Show Billboards From:</h5>
                    <a href="#" class="file-control active">Company</a>
                    <a href="#" class="file-control">Proposal</a>
                    <div class="hr-line-dashed"></div>
                    <button class="btn btn-primary btn-block">Save</button>
                    <div class="hr-line-dashed"></div>
                    <h5>Billboard Faces</h5>
                    <ul class="folder-list" style="padding: 0">
                        <li><a href=""><i class="material-icons">panorama</i> Files</a></li>
                        <li><a href=""><i class="material-icons">panorama</i> Pictures</a></li>
                        <li><a href=""><i class="fa fa-folder"></i> Web pages</a></li>
                        <li><a href=""><i class="fa fa-folder"></i> Illustrations</a></li>
                        <li><a href=""><i class="fa fa-folder"></i> Films</a></li>
                        <li><a href=""><i class="fa fa-folder"></i> Books</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped="true">
    .map-controls {
        background: white;
        width: 320px;
        position: absolute;
        top: 0;
        bottom: 0;
        margin-top: 30px;
        z-index: 1;

        .material-icons {
            font-size: inherit;
        }
    }
</style>

<script>

    import * as Slc from "../../../vue/http";

    export default {

        props: {
            proposal: {required: true}
        },

        data() {
            return {}
        },

        created() {

        },

        methods: {}

    }
</script>