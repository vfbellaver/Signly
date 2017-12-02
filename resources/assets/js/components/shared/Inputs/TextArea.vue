<template>
    <textarea class="form-control" v-model="value" :name="name"></textarea>
</template>

<script>
    export default {
        mixins: [require('../Mixins/Model')]
    }
</script>