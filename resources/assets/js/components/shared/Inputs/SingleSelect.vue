<template>
    <div>
        <multiselect
                v-model="internalValue"
                track-by="id"
                :label="labelValue"
                :options="options"
                :searchable="true"
                :internal-search="true"
                :placeholder="placeholder"
                :value="value"
        ></multiselect>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    export default {
        mixins: [require('../Mixins/Model')],
        components: {
            Multiselect
        },

        props: {
            api: {required: false},
            url: {required: false},
            label: {required: false},
            placeholder: {required: false}
        },

        data() {
            return {
                options: []
            }
        },

        computed: {
            route() {
                if (this.url) return this.url;
                else return laroute.route(`api.${this.api}.index`);
            },

            labelValue(){
               if(this.label === null){
                   return 'name';
               } else {
                   return this.label
               }
            }
        },

        created() {
            Slc
                .find(this.route)
                .then((response) => {
                    this.options = response;
                });
        },
    }
</script>