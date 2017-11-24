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
                    <div class="faces-box">
                        <div class="dd-list" v-if="proposal">
                            <div class="dd-item" v-for="face in $store.state.proposal.billboard_faces">
                                <div class="dd-content">{{face.code}} - {{face.pivot.price | money('$')}}</div>
                                <div class="dd-action">
                                    <button type="button" class="btn btn-xs btn-default"
                                            @click="centerFace(face)">
                                        <i class="fa fa-dot-circle-o"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="proposal" class="hr-line-dashed"></div>

                    <div v-if="proposal" class="social-feed-box">
                        <div class="social-avatar">
                            <a href="javascript:;" class="pull-left">
                                <img alt="image" v-if="proposal.team.logo" :src="proposal.team.logo">
                                <img alt="image" src="/images/default-logo.png" v-else>
                            </a>
                            <div class="media-body">
                                <a href="javascript:;">
                                    {{proposal.team.name}}
                                </a>
                                <small class="text-muted">{{proposal.created_at_str | date('MM/DD/YYYY')}}</small>
                            </div>
                        </div>
                        <div class="social-body">
                            <p>Leave your comments bellow</p>
                        </div>
                        <div class="social-footer">
                            <div class="p-h-lg" v-if="!comments.length">Empty</div>
                            <div v-else class="comment-box" ref="comments">
                                <div class="social-comment" v-for="(comment, index) in comments">
                                    <div class="media-body">
                                        <a href="#">{{ comment.name }}</a>
                                        {{ comment.comment }}
                                        <br>
                                        <small class="text-muted">{{ comment.created_at }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="social-comment">
                                <div class="media-body">
                                    <form-group :form="form" field="from_name" v-if="!user.id">
                                        <input-text v-model="form.from_name" id="from_name" name="from_name"
                                                    class="input-sm"
                                                    placeholder="Your name:"></input-text>
                                    </form-group>
                                    <form-group :form="form" field="comment">
                                        <textarea v-model="form.comment" id="comment" name="comment"
                                                  @keypress.enter="comment" class="form-control"
                                                  placeholder="Write comment..." :disabled="form.busy"></textarea>
                                    </form-group>
                                    <div class="btn-group">
                                        <button class="btn btn-white btn-xs" @click="comment" :disabled="form.busy">
                                            <i class="fa fa-comments"></i>
                                            Comment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="clearfix"></div>

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
        margin-top: 0;
        z-index: 1;
        .ibox {
            margin-top: 4px;
            .ibox-content {
                border-top-width: 0;
            }
        }
        .faces-box {
            height: 180px;
            overflow-y: auto;
        }
        .comment-box {
            height: 180px;
            overflow-y: auto
        }
        .dd-list {
            .dd-item {
                background: #f5f5f5;
                border: 1px solid #e7eaec;
                margin: 4px 0;
                padding: 5px 10px;
                .dd-handle, .dd-content, .dd-action {
                    display: table-cell;
                }
                .dd-content {
                    width: 324px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                    margin: 0 8px;
                }
                .dd-action {
                    width: 36px;
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
        props: {},
        store,
        components: {
            Draggable,
        },
        data() {
            return {
                sendDown: true,
                form: this.buildForm(),
                commentsView: null,
                user: window.Slc.user,
            }
        },
        computed: {
            markers() {
                return this.$store.state.markers;
            },
            proposal() {
                return this.$store.state.proposal;
            },
            comments() {
                return this.$store.state.comments;
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
            const self = this;

            const pullComments = function () {
                if (self.form.comment) {
                    setTimeout(() => {
                        pullComments();
                    }, 3000);
                    return;
                }
                if (!self.$store.state.proposal) {
                    setTimeout(() => {
                        pullComments();
                    }, 3000);
                    return;
                }
                const lengthBefore = self.$store.state.comments.length;
                self.$store.dispatch('fetchComments', self.$store.state.id)
                    .then(() => {
                        const lengthAfter = self.$store.state.comments.length;
                        if (lengthBefore !== lengthAfter || self.sendDown) {
                            self.sendDown = false;
                            self.$forceUpdate();
                            self.moveDown();
                        }
                    });
                setTimeout(() => {
                    pullComments();
                }, 3000);
            };
            this.$store.watch(state => {
                    return state.comments;
                },
                () => {
                    if (self.comments.length && self.sendDown) {
                        self.sendDown = false;
                        self.moveDown();
                    }
                },
                {
                    deep: true
                });
            pullComments();
        },
        methods: {
            centerFace(face) {
                this.$emit('centerFace', face);
            },

            comment(evt) {
                if (evt.shiftKey) {
                    return true;
                }
                evt.preventDefault();
                console.log('Comment');
                this.form.proposal = this.proposal;
                this.form.proposal_id = this.$store.state.id;
                this.$store.dispatch('saveComment', this.form)
                    .then(() => {
                        this.$forceUpdate();
                        this.moveDown();
                        this.form.comment = null;
                    });
            },
            moveDown() {
                let self = this;
                this.$nextTick(() => {
                    if (self.$refs.comments) {
                        setTimeout(() => {
                            self.$refs.comments.scrollTop = self.$refs.comments.scrollHeight;
                        }, 500);
                    }
                });
            },
            buildForm() {
                return new SlcForm({
                    proposal: null,
                    proposal_id: null,
                    from_name: null,
                    comment: null,
                    timezone: moment.tz.guess(),
                });
            },
        }
    }
</script>
