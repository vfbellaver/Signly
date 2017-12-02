<template>
    <input type="number" class="form-control" v-model="value" :name="name"/>
</template>

<script>
    export default {
        mixins: [require('../Mixins/Model')]
    }
</script>