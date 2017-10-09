<template>
    <div>
        <box>
            <box-title>
                <h5>Billboard Faces</h5>
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
                                <h3>
                                    <small>Code:</small>
                                    {{billboardFace.code}}
                                    <small>Label:</small>
                                    {{billboardFace.label}}
                                </h3>
                                <hr>
                                <column size="3">
                                    <h4>U$ : </h4>
                                </column>
                                <column size="9">
                                    <h2>{{formatMoney(billboardFace.hard_cost)}} &nbsp </h2>
                                </column>

                                <column size="12">
                                    <btn-success size="xs" @click.native="edit(billboardFace)">
                                        <icon icon="edit"></icon>
                                    </btn-success>
                                    <btn-danger @click.native="destroy(billboardFace)"
                                                :disabled="billboardFace.destroyForm.busy"
                                                size="xs">
                                        <spinner v-if="billboardFace.destroyForm.busy"></spinner>
                                        <icon icon="trash" v-else></icon>
                                    </btn-danger>
                                </column>
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
        margin-top: 0px;
        .ibox-title {
            margin-top: 0;
            border: 0;
            padding-top: 0;
            h5 {
                font-size: 13px;
                font-weight: bold;
                margin: 0;
            }
        }
        .ibox-content {
            border: 0;
        }

        > hr {
            margin: 5px;
        }

        h3 {
            small {
                padding-left: 12px;
            }
        }

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
                billboardFaces: [],
            }
        },

        computed: {},

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
            },

            formatMoney(money) {
                money = money.toString();
                var tmp = money.replace(".", "");
                tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
                if (tmp.length > 6)
                    tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

                return tmp;
            }
        }
    }
</script>