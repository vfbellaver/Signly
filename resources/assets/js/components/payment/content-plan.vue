<template>
    <div>
        <div>
                <strong>{{name}}</strong>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {required: true},
        },

    }
</script>