<template>
    <div class="tab-pane" :class="{'active' : isActive}">
        <div class="panel-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            tabId: {required: true},
            name: {required: true},
            selected: {'default': false}
        },

        data() {
            return {
                isActive: false
            };
        },

        computed: {
            href() {
                return '#' + this.tabId.toLowerCase().replace(/ /g, '-');
            }
        },

        mounted() {
            this.isActive = this.selected;
        },
    }
</script>