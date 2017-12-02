<template>
    <input class="form-control" :value="value" :name="name" @input="updateValue($event.target.value)"/>
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