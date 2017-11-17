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
                                <div class="dd-content">{{face.code}}</div>
                                <div class="dd-action">
                                    <button type="button" class="btn btn-xs btn-primary"
                                            @click="editBillboardFace(face)">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-danger"
                                            @click="removeBillboardFace(face)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </draggable>
                    </div>
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
                    width: 34px;
                    background: inherit;
                    border: none;
                }

                .dd-content {
                    width: 220px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                    margin: 0 8px;
                }

                .dd-action {
                    width: 64px;
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
        props: {},
        store,
        components: {
            Draggable,
        },
        data() {
            return {
                billboardFaces: []
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
            }
        }

    }
</script>