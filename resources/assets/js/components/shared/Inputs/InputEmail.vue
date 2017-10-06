


<template>
    <input class="form-control" v-model="internalValue" :name="name"/>
</template>

<script>
    export default {
        mixins: [require('../Mixins/Model')]
    }
</script>