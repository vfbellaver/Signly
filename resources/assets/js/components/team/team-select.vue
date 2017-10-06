<template>
    <div>
        <single-select
                v-model="internalValue"
                :value="value"
                api="team"
                placeholder="Select a Team">
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