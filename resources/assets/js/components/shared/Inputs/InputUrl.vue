<template>
    <input class="form-control" v-model="value" :name="name" placeholder="http://"/>
</template>

<script>
    export default {
        mixins: [require('../Mixins/Model')]
    }
</script>