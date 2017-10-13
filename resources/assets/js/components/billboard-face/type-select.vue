<template>
    <div>
        <select class="form-control" v-model="internalValue" v-bind:value="value" :name="name">
            <option selected="selected">Static</option>
            <option>Digital</option>
        </select>
    </div>
</template>

<script>
    export default {
        mixins: [require('../shared/Mixins/Model')],

        computed:{

        },

        data(){
          return{
            static: 'Static'
          }
        },

        mounted(){
            this.selected();
        },

        methods:{
            selected () {
                const self = this;
                if(self.internalValue === null){
                    return  self.internalValue = 'Static';
                }
                return self.internalValue;
            }
        }
    }
</script>