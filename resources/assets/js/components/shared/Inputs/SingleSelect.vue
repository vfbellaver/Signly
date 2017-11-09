<template>
    <div>
        <multi-select
                v-model="internalValue"
                track-by="id"
                :label="labelValue"
                :options="options"
                :searchable="true"
                :internal-search="true"
                :placeholder="placeholder"
                :value="value"
        ></multi-select>
    </div>
</template>

<script>
    import MultiSelect from 'vue-multiselect/src/Multiselect';

    export default {
        mixins: [require('../Mixins/Model')],
        components: {
            MultiSelect
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

            labelValue() {
                if (this.label === null) {
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