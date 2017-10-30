<template>
    <div class="ibox">
        <div class="ibox-title">
            <h5>{{billboard.name}}</h5>
        </div>
        <div class="ibox-content">
            <div class="team-members">
                <span v-for="face in billboard.billboard_faces">
                    <img alt="Billboard Face" class="img-circle" :src="face.photo">
                </span>
            </div>
            <h4>Description</h4>
            <p class="description">{{billboard.description}}</p>
            <hr/>
            <div class="row  m-t-sm">
                <div class="col-md-12">
                    <div class="btn-group pull-left">
                        <button class="btn btn-white btn-sm" @click="details"><i class="fa fa-plus"></i> Details</button>
                    </div>
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
    @import "../../../sass/variables";
    @import "../../../sass/mixins";
    @import "../../../sass/placeholders";
    @import "../../../sass/breakpoints";

    p.description {
        @include multi-line-text-ellipse(100%, 54px, 3);
    }

</style>

<script>

    export default {
        props: {
            billboard: {required: true}
        },
        methods: {
            edit() {
                this.$emit('edit', this.billboard);
            },
            destroy() {
                this.$emit('destroy', this.billboard);
            },
            details(){
                this.$emit('details', this.billboard);
            }
        }
    }

</script>