<template>
        <modal>
            <modal-body>
                teste
                teste
                teste
                teste
            </modal-body>
        </modal>
</template>

<script>
    import Modal from './../shared/Mixins/ModalForm'
    export default {
        mixins: [Modal],

        props: {
            src: {required: true},
        },

    }
</script>