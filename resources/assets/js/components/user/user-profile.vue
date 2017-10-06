<template>
    <div class="card-container">
        <div class="card-body">
            <img :src="user.photo_url"/>
            <div class="profile-name">
                <h3>Name: {{user.name}}</h3>
            </div>
            <hr>
            <h3><icon icon="envelope"></icon>&nbsp {{user.email}}</h3>
            <h3><icon icon="users"></icon>&nbsp {{user.team.name}}</h3>
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
                user: Slc.user
            }
        },

        created(){
        },

        methods: {

        }
    }

</script>