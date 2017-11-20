<template>
    <modal size="lg">
        <modal-header>Comments</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="12">
                        <span v-if="! form.billboard_face">Empty</span>
                        <div v-else class="comments" ref="comments">
                            <div class="social-comment" v-for="(comment, index) in form.billboard_face.comments" :key="comment.id">
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
                            <input-text v-model="form.from_name" id="from_name" name="from_name" placeholder="Your name:"></input-text>
                        </form-group>
                    </column>
                </row>
                <row>
                    <column size="12">
                        <form-group :form="form" field="comment">
                            <text-area v-model="form.comment" id="comment" name="comment" placeholder="Add a comment"></text-area>
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
    import ModalForm from '../shared/Mixins/ModalForm';

    export default {
        mixins: [ModalForm],            
        data() {
            return {
                api: 'comment'
            }
        },
        created() {
            this.$on('saved', (obj) => {
                console.info('saved', obj);
            });
        },
        methods: {
            buildForm(billboardFace) {
                return new SlcForm({
					billboard_face: billboardFace,
					from_name: null,
					comment: null
                });
            },
            moveDown() {
                let self = this;
                this.$nextTick(() => {
                    if( self.$refs.comments ) {
                        setTimeout(() => {
                            self.$refs.comments.scrollTop = self.$refs.comments.scrollHeight;
                        }, 500);
                    }
                });
            }
        },
        watch: {
            form: {
                 handler: function(newValue) {
                    this.moveDown();
                },
                deep: true
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
