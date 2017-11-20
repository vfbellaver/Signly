<template>
    <div>
        <data-viewer
                ref="dataViewer"
                v-bind="$data"
                :btn-share="true"
                @share="share"
                :btn-edit="true"
                @edit="edit"
                :btn-destroy="true"
                @destroy="destroy"
        >
        </data-viewer>

        <billboard-face-form v-if="billboardId" ref="billboardFaceForm" :billboardId="billboardId"
                             @updated="billboardFaceUpdated"
        ></billboard-face-form>
    </div>
</template>
<script>
    import DataViewer from '../shared/DataViewer';
    import BillboardFaceForm from './edit/billboard-face-form';
    import * as Slc from "../../vue/http";

    export default {
        components: {
            DataViewer,
            BillboardFaceForm
        },
        data: () => ({
            title: 'Billboard List View',
            source: laroute.route('api.billboard-face.search'),
            defaultColumn: 'code',
            billboardId: null
        }),
        methods: {
            share(billboard) {
                console.log(billboard);
                const win = window.open(billboard.public_url, '_blank');
                win.focus();
            },
            destroy(billboard) {
                console.log("destroy", billboard);
                billboard.destroyForm = new SlcForm({});
                Slc.delete(laroute.route('api.billboard-face.destroy', {billboard_face: billboard.id}), billboard.destroyForm)
                    .then(() => {
                        this.$refs.dataViewer.fetchIndexData();
                    });
            },
            edit(billboard) {
                console.log("edit", billboard);
                this.billboardId = billboard.billboard_id;
                this.$nextTick(() => {
                    this.$refs.billboardFaceForm.show(billboard);
                });
            },
            billboardFaceUpdated(face) {
                console.log("billboardFaceUpdated", face);
                this.$refs.dataViewer.fetchIndexData();
            },
        }
    }
</script>