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
                <div class="row">
                    <div class="col-md-6" v-for="billboardFace in billboardFaces">
                        <div class="contact-box">
                            <div class="col-sm-6">
                                <div class="text-center">
                                    <img alt="image" class="m-t-xs img-responsive"
                                         :src="billboardFace.photo">
                                    <div class="m-t-xs font-bold">{{billboardFace.code}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4>
                                    <small>Type: &nbsp</small>
                                    <strong>{{billboardFace.type}}</strong>
                                </h4>
                                <p>
                                    {{billboardFace.width}} W x {{billboardFace.height}} H
                                </p>
                                <h1>
                                    <small> U$ :</small>
                                    {{billboardFace.hard_cost}}
                                </h1>
                            </div>
                            <div class="clearfix"></div>
                            <div class="contact-box-footer">
                                <div class="m-t-xs btn-group pull-right">
                                    <button @click="edit(billboardFace)" class="btn btn-xs btn-white"><i
                                            class="fa fa-edit"></i> EDIT
                                    </button>
                                    <button @click="destroy(billboardFace)" class="btn btn-xs btn-white"><i
                                            class="fa fa-trash"></i> DELETE
                                    </button>
                                </div>
                            </div>

                        </div>
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
            img {
                margin: auto;
            }
        }

        .contact-box-footer {
            margin-top: 10px;
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
    import BillboardFaceForm from './billboard-face-form';

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