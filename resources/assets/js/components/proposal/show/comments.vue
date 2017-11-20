<template>
    <modal size="lg">
        <modal-header>Comments</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="12">
                        <span v-if="! form.proposal || form.proposal.comments.length === 0">Empty</span>
                        <div v-else class="comments" ref="comments">
                            <div class="social-comment" v-for="(comment, index) in form.proposal.comments"
                                 :key="comment.id">
                                <div class="media-body">
                                    <a href="#">{{ comment.name }}</a>
                                    {{ comment.comment }}
                                    <br>
                                    <small class="text-muted">{{ comment.created_at }}</small>
                                </div>
                            </div>
                        </div>
                    </column>
                </row>
            </modal-body>

            <modal-footer :cancel-button="false">
                <row v-if="! $root.user.id">
                    <column size="12">
                        <form-group :form="form" field="from_name">
                            <input-text v-model="form.from_name" id="from_name" name="from_name"
                                        placeholder="Your name:"></input-text>
                        </form-group>
                    </column>
                </row>
                <row>
                    <column size="12">
                        <form-group :form="form" field="comment">
                            <text-area v-model="form.comment" id="comment" name="comment"
                                       placeholder="Add a comment"></text-area>
                        </form-group>
                    </column>
                </row>
                <row>
                    <column size="12">
                        <btn-cancel></btn-cancel>
                        <btn-submit :disabled="form.busy">
                            <spinner v-if="form.busy"></spinner>
                        </btn-submit>
                    </column>
                </row>
            </modal-footer>
        </form-submit>
    </modal>
</template>

<script>
    import store from './store';

    export default {
        store,
        data: () => ({
            form: new SlcForm({})
        }),
        computed: {
            proposal() {
                return this.$store.state.proposal;
            }
        },
        methods: {
            show() {
                $(this.$el).modal('show');
                this.buildForm();
                this.moveDown();
            },
            save() {
                this.$store.dispatch('saveComment', this.form)
                    .then(() => {
                        this.$forceUpdate();
                        this.moveDown();
                        this.buildForm();
                    });
            },
            buildForm() {
                this.form = new SlcForm({
                    proposal: this.proposal,
                    from_name: null,
                    comment: null
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
            }
        }
    }
</script>

<style lang="scss" scoped>
    .social-comment {
        background-color: white;
        padding: 10px 20px;
        border: 1px solid #e5e5e5;
    }

    .comments {
        overflow-y: auto;
        height: 250px;
    }
</style>
