<template>
    <data-viewer v-bind="$data"></data-viewer>
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
        })
    }
</script>