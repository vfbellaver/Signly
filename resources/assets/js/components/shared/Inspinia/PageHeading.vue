<template>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{data.title}}</h2>
            <ol class="breadcrumb">
                <li v-for="item in data.breadcrumb">
                    <a :href="item.url">{{item.title}}</a>
                </li>
                <li class="active">
                    <strong>{{data.title}}</strong>
                </li>
            </ol>
        </div>
    </div>
</template>

<style lang="scss">

</style>

<script>
    export default {
        props: {
            data: {required: true}
        }
    }
</script>