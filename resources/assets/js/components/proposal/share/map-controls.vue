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
                    <h5>Billboard Faces</h5>
                    <div class="dd-list" v-if="proposal">
                        <div class="dd-item"
                             v-for="face in $store.state.proposal.billboard_faces"
                             :key="face.id">
                            <div class="dd-content">{{face.code}} - {{face.pivot.price | money('$')}}</div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="hr-line-dashed"></div>
                    <h4 class="text-right p-xs">Total: {{total | money('$')}}</h4>
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
                    width: 34px;
                    background: inherit;
                    border: none;
                }

                .dd-content {
                    width: 240px;
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
            return {}
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
                    total += Number.parseFloat(f.pivot.price);
                }
                console.log("Total", total);
                return total.toFixed(2);
            },
            pdfLink() {
                if (!this.$store.state.proposal) {
                    return '';
                }
                return laroute.route('proposal.share.pdf', {proposal: this.$store.state.id});
            },
        },

        mounted() {

        },

        methods: {}
    }
</script>