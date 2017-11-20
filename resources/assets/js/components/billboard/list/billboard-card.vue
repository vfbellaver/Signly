<template>
    <div class="ibox">
        <div class="ibox-title">
            <h5><i class="fa fa-map-marker"></i> {{billboard.address}}</h5>
        </div>
        <div class="ibox-content">
            <div class="faces-container">
                <div class="feed-activity-list">
                    <div class="feed-element" v-for="face in billboard.billboard_faces">
                        <a class="pull-left">
                            <img v-image-preview alt="Billboard Face" class="img-circle" :src="face.photo_url">
                        </a>
                        <div class="media-body ">
                            <small class="pull-right">{{face.type}}</small>
                            <strong>{{face.code}}</strong> - Facing {{face.label}}<br>
                            <!--<small class="text-muted">Rate Card {{face.rate_card | money('$')}}</small>-->
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="false" class="team-members">
                <span v-for="face in billboard.billboard_faces">
                    <img alt="Billboard Face" class="img-circle" :src="face.photo_url">
                </span>
            </div>
            <hr/>
            <div class="row  m-t-sm">
                <div class="col-md-12">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm" @click="edit"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-white btn-sm" @click="destroy"><i class="fa fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped="true">
    @import "../../../../sass/variables";
    @import "../../../../sass/mixins";
    @import "../../../../sass/placeholders";
    @import "../../../../sass/breakpoints";

    .ibox-title {
        h5 {
            @include text-ellipse(98%);
        }
    }

    .team-members {
        .img-circle {
            margin-right: 4px;
        }
    }

    .faces-container {
        height: 261px;
    }

    .feed-activity-list {
        .feed-element {
            &:last-of-type {
                border-bottom: none;
            }
        }
    }

</style>

<script>

    export default {
        props: {
            team: {required: true},
            billboard: {required: true},
        },
        methods: {
            edit() {
                this.$emit('edit', this.billboard);
            },
            destroy() {
                this.$emit('destroy', this.billboard);
            },
        }
    }

</script>