<template>
    <div class="filters">
        <h3>Filters</h3>
        <div class="filter">
            <select class="form-control input-sm" v-model="filters.type">
                <option :value="null">All</option>
                <option value="Static">Static</option>
                <option value="Digital">Digital</option>
            </select>
        </div>
    </div>
</template>

<style lang="scss">
    .filters {
        width: 200px;
        height: 250px;
        background: white;
        position: absolute;
        padding: 12px;
        right: 12px;
        top: 77px;
        border-radius: 4px;
        box-shadow: rgba(150, 150, 150, 0.3) 1px 1px;

        h3 {
            font-size: 14px;
            border-bottom: 1px dashed #e7eaec;
            padding: 6px 0;
        }

        .filter {
            font-size: 11px;
        }
    }
</style>

<script>
    import store from './store';

    export default {
        store,
        data() {
            return {
                filters: {
                    type: null,
                },
            }
        },
        computed: {
            proposal() {
                return this.$store.state.proposal;
            }
        },
        watch   : {
            filters: {
                handler(val) {
                    this.$store.dispatch('setFilters', this.filters);
                },
                deep: true
            }
        },
        methods : {}
    }
</script>
