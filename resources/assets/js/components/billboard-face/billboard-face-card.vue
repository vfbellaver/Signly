<template>
    <div>

    </div>
</template>

<script>
    export default {

        props: {
            billboardFace: {required: true},
        },

        methods: {
            edit() {
                this.$emit('edit', this.billboardFace);
            },
            destroy() {
                this.$emit('destroy', this.billboardFace);
            }
        }
    }
</script>