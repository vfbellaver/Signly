<template>
    <div class="modal-footer">
        <btn-cancel v-if="cancelButton"></btn-cancel>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            cancelButton: {
                type: Boolean,
                required: false,
                default: true
            }
        }
    }
</script>