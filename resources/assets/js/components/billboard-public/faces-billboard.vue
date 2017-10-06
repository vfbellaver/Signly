<template>
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Home</a></li>
        <li role="presentation"><a href="#">Profile</a></li>
        <li role="presentation"><a href="#">Messages</a></li>
    </ul>
</template>
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