<template>

        <div v-show="isActive">
           <slot></slot>
        </div>
    
</template>

<script>
    export default {

        props:{
            name: {required: true},
            selected: {default: false}
        },

        data(){
           return{
               isActive: false
           }
        },

        computed:{

        },

        methods:{

        },

        mounted(){
            this.isActive = this.selected;
        }

    }
</script>