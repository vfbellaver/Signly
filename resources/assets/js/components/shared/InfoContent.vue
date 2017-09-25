<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Name: {{name}}
        </div>
        <div class="panel-body">Description : {{description}} </div>
        <div class="panel-footer">Address : {{address}} </div>
    </div>
</template>

<script>

    export default {

        props: {

            name:{
              required:true,
            },

            description:{
                required:true,
            },

            address:{
                required:true,
            }
        },

        data() {
            return {
               xy: 'aqui foi o data'
            }
        },

        computed: {

            cd () {
              return this.aB.toUpperCase();
            }
        },

    }
</script>