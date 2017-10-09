<template>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{page.title}}</h2>
            <ol class="breadcrumb">
                <li v-for="item in page.breadcrumb">
                    <a :href="item.url">{{item.title}}</a>
                </li>
                <li class="active">
                    <strong>{{page.title}}</strong>
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
            page: {required: true}
        }
    }
</script>