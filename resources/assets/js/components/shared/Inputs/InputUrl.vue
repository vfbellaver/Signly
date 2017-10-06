<template>
    <input class="form-control" v-model="internalValue" v-bind:value="value" :name="name" placeholder="http://"/>
</template>

<script>
    export default {
        mixins: [require('../Mixins/Model')]
    }
</script>