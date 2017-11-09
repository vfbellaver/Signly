<template>
    <div>
        <single-select
                v-model="internalValue"
                :value="value"
                api="proposal"
                placeholder="Select a Proposal">
        </single-select>
    </div>
</template>

<script>
    import SingleSelect from '../shared/Inputs/SingleSelect';

    export default {
        mixins: [require('../shared/Mixins/Model')],
        components: {
            SingleSelect
        },
    }
</script>