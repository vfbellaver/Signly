<template>
    <div class="card-container">
        <div class="card-body">
            <!--<img :src="user.photo_url"/>-->
            <img src="/images/profile.jpg"/>

            <div class="profile-name">
                <h3>Name: teste</h3>
            </div>
            <hr>
            <h3><icon icon="envelope"></icon>&nbsp teste</h3>
        </div>
    </div>
</template>

<style lang="scss" scoped="scoped">
    .card-container {
        background-color: #FFFFFF;
    }
    .card-container:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
    .card-body {
        font-family: 'Roboto', helvetica, arial, sans-serif;
        font-weight: 500;
        text-align: center;
    }
    .profile-name {
        width: 100%;
        padding: 8px;
        background-color: #0276a0;
        color: #FFFFFF;
    }
</style>

<script>
    export default {
        data() {
            return {
                user: null
            }
        },
        created(){
            this.reload();
        },
        /*
         mounted(){
         this.reload();
         },
         */
        methods: {
            reload() {
                Slc.get(laroute.route('api.user.index'))
                    .then((response) => {
                        this.user = response;
                        this.user = this.user[0];
                    });
            },
        }
    }
</script>