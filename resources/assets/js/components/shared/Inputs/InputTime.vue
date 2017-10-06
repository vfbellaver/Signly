<template>
    <vue-timepicker v-model="internalValue" v-bind:value="value" :name="name"></vue-timepicker>
</template>
<script>
    import VueTimepicker from "../../../../../../node_modules/vue2-timepicker/src/vue-timepicker";
    export default {
        components: {VueTimepicker},
        mixins: [require('../Mixins/Model')],
    }
</script>