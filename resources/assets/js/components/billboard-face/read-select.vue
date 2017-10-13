<template>
    <div>
        <select class="form-control" v-model="internalValue" v-bind:value="value" :name="name">
            <option :selected="selected">Right</option>
            <option>Left</option>
            <option>Across</option>
        </select>
    </div>
</template>

<script>
    export default {
        mixins: [require('../shared/Mixins/Model')],

        computed:{
            selected () {
                const self = this;
                if(self.internalValue === null){
                    return  self.internalValue = 'Right';
                }
                return self.internalValue;
            }
        },

        created(){
           //this.selected();
        },

        methods:{

        }
    }
</script>