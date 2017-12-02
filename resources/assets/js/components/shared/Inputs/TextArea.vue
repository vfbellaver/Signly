<template>
    <textarea class="form-control" :value="value" @input="updateValue($event.target.value)" :name="name"></textarea>
</template>

<script>
    export default {
        props  : {
            value: {required: true},
            name : {required: true},
        },
        data() {
            return {}
        },
        methods: {
            updateValue(value) {
                this.$emit('input', value);
            }
        }
    }
</script>