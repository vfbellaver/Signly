<template>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
        <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
    </ul>


</template>
<style lang="scss" scoped="scoped">
    .nav-tabs {
        background-color: #eeeeee;
        padding-top:5px;
        padding-left:5px;
        border: 1px solid #ddd;

    }

    .tab-content {
        color : #000000;
        background-color: #ffffff;
        padding : 5px 15px;
        margin-top: -1px;
        border: 1px solid #ddd;
    }
</style>
<script>
    export default{
        props: {
            billboardId: {required: true}
        },

        data(){
            return {
                billboardFaces: [],
            }
        },

        mounted(){
            this.load();
        },

        methods: {
            load() {
                let self = this;
                Slc.get(laroute.route('api.billboard-face.index', {bid: this.billboardId}))
                    .then((response) => {
                        self.billboardFaces = response;
                    });
            },
        }
    }
</script>