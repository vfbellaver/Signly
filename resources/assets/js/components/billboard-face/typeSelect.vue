<template>
    <div>
        <select class="form-control" v-model="internalValue" v-bind:value="value" :name="name">
            <option selected>Static</option>
            <option>Digital</option>
        </select>
    </div>
</template>

<script>
    export default {
        mixins: [require('../shared/Mixins/Model')],

        computed:{
        },

        created(){
            this.selected();
        },

        methods:{
            selected () {
                const self = this;
                if(self.internalValue === null){
                    return  self.internalValue = 'Right';
                }
                return self.internalValue;
            }
        }
    }
</script>