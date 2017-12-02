<template>
    <div class="map-controls">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="file-manager">
                    <h5>Time Range</h5>
                    <div v-if="proposal">
                        {{proposal.from_date | date('MM/DD/YYYY')}} - {{proposal.to_date | date('MM/DD/YYYY')}}
                    </div>
                    <div class="hr-line-dashed"></div>
                    <h5>Share Link</h5>
                    <div class="form-group">
                        <div class="input-group mb-2 mb-sm-0">
                            <div class="input-group-addon">
                                <i class="fa fa-clone" aria-hidden="true" style="cursor: pointer;"
                                   data-toggle="tooltip" title="Copy to clipboard"
                                   @click="copyToClipboard"
                                ></i>
                            </div>
                            <input ref="shareLink" type="text" v-if="proposal" class="form-control"
                                   v-model="proposal.share_link" readonly="true"/>
                        </div>
                    </div>

                    <a class="btn btn-primary btn-block m-t-sm" :href="pdfLink">Generate Proposal</a>

                    <div class="hr-line-dashed"></div>
                    <h5>Billboard Faces</h5>
                    <div class="dd-list">
                        <draggable v-model="billboardFaces"
                                   :options="{group:'faces', draggable:'.dd-item', handle: '.dd-handle'}"
                                   @end="end">
                            <div class="dd-item"
                                 v-for="face in billboardFaces"
                                 :key="face.id">
                                <div class="dd-handle">
                                    <i class="fa fa-arrows"></i>
                                </div>
                                <div class="dd-content">{{face.code}} - {{face.pivot.price | integer('$')}}</div>
                                <div class="dd-action">
                                    <button type="button" class="btn btn-xs btn-primary"
                                            @click="editBillboardFace(face)">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-danger"
                                            @click="removeBillboardFace(face)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-default"
                                            @click="centerFace(face)">
                                        <i class="fa fa-dot-circle-o"></i>
                                    </button>
                                </div>
                            </div>
                        </draggable>
                    </div>
                    <div class="clearfix"></div>

                    <div class="hr-line-dashed"></div>
                    <h4 class="text-right p-xs">Total: {{total | integer('$')}}</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped="true">
    .map-controls {
        background: white;
        width: 400px;
        position: absolute;
        top: 0;
        bottom: 0;
        margin-top: 32px;
        z-index: 1;

        .dd-list {
            .dd-item {
                background: #f5f5f5;
                border: 1px solid #e7eaec;
                margin: 4px 0;
                padding: 5px 10px;

                .dd-handle, .dd-content, .dd-action {
                    display: table-cell;
                }

                .dd-handle {
                    width: 36px;
                    background: inherit;
                    border: none;
                }

                .dd-content {
                    width: 216px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                    margin: 0 8px;
                }

                .dd-action {
                    width: 108px;
                    text-align: right;
                }

                &.sortable-ghost {
                    margin: 5px 0;
                    padding: 0;
                    min-height: 30px;
                    background: #f2fbff;
                    border: 1px dashed #b6bcbf;
                    box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    * {
                        opacity: 0;
                    }
                }
                &.sortable-chosen {

                }
            }
        }
    }
</style>

<script>

    import * as Slc from "../../../vue/http";
    import store from './store';
    import Draggable from 'vuedraggable'

    export default {
        props     : {},
        store,
        components: {
            Draggable,
        },
        data() {
            return {
                billboardFaces: [],
            }
        },

        computed: {
            user() {
                return this.$store.state.user;
            },
            billboard() {
                return this.$store.state.billboard;
            },
            billboards() {
                return this.$store.state.billboards;
            },
            markers() {
                return this.$store.state.markers;
            },
            proposal() {
                return this.$store.state.proposal;
            },
            total() {
                if (!this.$store.state.proposal) {
                    return 0;
                }
                const faces = this.$store.state.proposal.billboard_faces;
                let total = 0;
                for (let i = 0; i < faces.length; i++) {
                    const f = faces[i];
                    let v = f.pivot.price.replace(',', "");
                    total += Number.parseFloat(v);
                }
                console.log("Total", total);
                return total.toFixed(2);
            },
            pdfLink() {
                if (!this.$store.state.proposal) {
                    return '';
                }
                return laroute.route('proposal.pdf', {proposal: this.$store.state.proposal.id});
            },
        },

        created() {
            const self = this;
            this.$store.watch(state => {
                    return state.proposal;
                },
                () => {
                    if (!self.$store.state.proposal) {
                        return;
                    }
                    this.billboardFaces = self.proposal.billboard_faces;
                },
                {
                    deep: true
                })
        },

        mounted() {
            $("[data-toggle='tooltip']").tooltip();
        },

        methods: {
            removeBillboardFace(face) {
                this.$emit('remove', face)
            },
            editBillboardFace(face) {
                this.$emit('edit', face)
            },
            end() {
                const orderList = [];
                for (let i = 0; i < this.billboardFaces.length; i++) {
                    const face = this.billboardFaces[i];
                    orderList.push(face.id);
                }
                this.$emit('reordered', orderList);
            },
            centerFace(face) {
                this.$emit('centerFace', face);
            },
            copyToClipboard() {
                $(this.$refs.shareLink).select();
                document.execCommand("copy");
            }
        }

    }
</script>