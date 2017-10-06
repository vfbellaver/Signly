
<template>
    <div>
        <box>
            <box-title>
                Billboard Faces
                <box-tools slot="tools">
                    <box-tool icon="plus" @click.native="add">New</box-tool>
                </box-tools>
            </box-title>
            <box-content>
                <div class="cards-line-separator" v-for="(billboardface, index) in billboardFaces">
                    <billboard-face-card
                            :billboard-face="billboardface"
                    >

                        <btn-success
                                size="xs"
                                @click.native="edit(billboardface)"
                        >
                            EDIT &nbsp
                            <icon icon="edit"/>
                        </btn-success>


                        <btn-danger @click.native="destroy(billboardface)"
                                    :disabled="billboardface.destroyForm.busy"
                                    size="xs"
                        >
                            <spinner v-if="billboardface.destroyForm.busy"></spinner>
                            <icon icon="trash" v-else/>
                        </btn-danger>

                    </billboard-face-card>
                </div>
            </box-content>
        </box>
        <billboard-face-form ref="form" :billboard-id="billboardId" @saved="formSaved"></billboard-face-form>
    </div>
</template>
<style lang="scss" scoped="scoped">
    .ibox  {
        margin-top: 22px;
    }
</style>
<script>
    import BillboardFaceForm from './billboard-face-form.vue';
    import ModalForm from '../shared/Mixins/ModalForm';
    export default {
        props: {
            billboardId: {required: true},
        },
        mixins: [ModalForm],
        components: {
            BillboardFaceForm
        },
        data() {
            return {
                billboardFaces: []
            }
        },
        mounted() {
            this.reload();
        },
        methods: {
            add() {
                this.$refs.form.show();
            },
            edit(billboardFace) {
                this.$refs.form.show(billboardFace);
            },
            reload() {
                let self = this;
                Slc.get(laroute.route('api.billboard-face.index', {bid: this.billboardId}))
                    .then((response) => {
                        self.billboardFaces = response;
                    });
            },
            formSaved(billboardFace) {
                let index = this.findIndex(billboardFace);
                index > -1 ? this.billboardFaces[index] = billboardFace : this.billboardFaces.push(billboardFace);
                this.$forceUpdate();
            },
            destroy(billboardFace) {
                let self = this;
                Slc.delete(laroute.route('api.billboard-face.destroy', {billboard_face: billboardFace.id}), billboardFace.destroyForm)
                    .then(() => {
                        self.removeBillboardFace(billboardFace);
                    });
            },
            removeBillboardFace(billboardFace) {
                this.billboardFaces.splice(this.findIndex(billboardFace), 1);
            },
            findIndex(billboardFace) {
                return this.billboardFaces.findIndex((_billboardFace) => {
                    return _billboardFace.id === billboardFace.id;
                });
            }
        }
    }
</script>