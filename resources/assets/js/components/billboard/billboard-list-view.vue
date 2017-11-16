<template>
    <data-viewer
            v-bind="$data"
            :btn-share="true"
            @share="share"
            :btn-edit="true"
            @edit="edit"
            :btn-destroy="true"
            @destroy="destroy"
    >
    </data-viewer>
</template>
<script>
    import DataViewer from '../shared/DataViewer';

    export default {
        components: {
            DataViewer
        },
        data: () => ({
            title: 'Billboard List View',
            source: laroute.route('api.billboard-face.search'),
            defaultColumn: 'code'
        }),
        methods: {
            share(billboard) {
                console.log(billboard);
            },
            destroy(billboard) {
                console.log(billboard);
            },
            edit(billboard) {
                console.log(billboard);
            }
        }
    }
</script>