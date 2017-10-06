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
                <div class="cards-line-separator" v-for="billboardFace in billboardFaces">
                    <div class="card-container">
                        <column size="4">
                            <img width="100%" :src="billboardFace.photo">
                        </column>
                        <column size="8">
                            <div class="card-body">
                                <box>
                                    <h3>Code: {{billboardFace.code}} &nbsp Label: {{billboardFace.label}} </h3>
                                    <box-content>
                                        <column size="12">
                                            <h4>Width: {{billboardFace.width}} &nbsp
                                                &nbsp Heigth: {{billboardFace.height}}
                                            </h4>
                                        </column>
                                        <column size="12">
                                            <h4>Monthly Impressions: {{formatImpressions}} &nbsp</h4>
                                            <h4>Hard Cost U$ : {{getMoney}} &nbsp </h4>
                                        </column>
                                        <column size="12">
                                            <btn-success size="xs" @click.native="edit(billboardFace)">
                                                EDIT &nbsp
                                                <icon icon="edit"></icon>
                                            </btn-success>
                                            <btn-danger @click.native="destroy(billboardFace)"
                                                        :disabled="billboardFace.destroyForm.busy"
                                                        size="xs">
                                                <spinner v-if="billboardFace.destroyForm.busy"></spinner>
                                                <icon icon="trash" v-else></icon>
                                            </btn-danger>
                                        </column>
                                    </box-content>
                                </box>
                            </div>
                        </column>
                        <div style="clear: both"></div>
                    </div>
                </div>
            </box-content>
        </box>
        <billboard-face-form ref="form" @saved="formSaved" :billboardId="billboardId"></billboard-face-form>
    </div>
</template>

<style lang="scss" scoped="scoped">
    .ibox {
        margin-top: 22px;
    }
</style>

<script>

    import _ from 'lodash';
    import * as Slc from "../../vue/http";
    import BillboardFaceForm from './billboard-face-form.vue';

    export default {
        props: {
            billboardId: {required: false},
        },
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