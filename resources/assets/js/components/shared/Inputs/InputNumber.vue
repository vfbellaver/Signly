
<template>
    <input type="number" class="form-control" v-model="internalValue" v-bind:value="value" :name="name"/>
</template>

<script>
    export default {
        mixins: [require('../Mixins/Model')]
    }
</script>