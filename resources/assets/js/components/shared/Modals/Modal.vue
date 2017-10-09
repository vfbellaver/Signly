<template>
    <div class="modal inmodal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" :class="modalSize">
            <div class="modal-content animated bounceInTop">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            size: {required: false}
        },
        computed: {
            modalSize() {
                if (!this.size) {
                    return "modal-md";
                }
                if (this.size === 'sm') {
                    return "modal-sm";
                }
                if (this.size === 'lg') {
                    return "modal-lg";
                }
            }
        }

    }
</script>