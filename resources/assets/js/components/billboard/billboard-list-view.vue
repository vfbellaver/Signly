<template>
    <box>
        <box-content>
        <code>query: {{ query }}</code>
        <datatable v-bind="$data"></datatable>
        </box-content>
    </box>
</template>
<script>
    export default {
        data: () => ({
            columns: [
                {title: 'ID', field: 'code', sortable: true},
                {title: 'Label', field: 'label', sortable: true},
                {title: 'Photo', field: 'photo'},
                {title: 'Height', field: 'height', sortable: true},
                {title: 'Width', field: 'width', sortable: true},
                {title: 'Reads', field: 'reads', sortable: true},
                {title: 'Hard Cost', field: 'hard_cost', sortable: true},
                {title: 'Type', field: 'type', sortable: true}
            ],
            data: [],
            total: 0,
            query: {},
            HeaderSettings: false
        }),
        watch: {
            query: {
                handler(query) {
                    Slc.post(laroute.route('api.billboard-face.search'), new SlcForm(query)).then(({rows, total}) => {
                        this.data = rows;
                        this.total = total;
                    })
                },
                deep: true
            }
        }
    }
</script>