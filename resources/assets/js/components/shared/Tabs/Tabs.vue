<template>
    <div class="tabs-container">
        <div class="tabs-left">
            <ul class="nav nav-tabs">
                <li v-for="tab in tabs" :class="{ 'active': tab.isActive }">
                    <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
                </li>
            </ul>

            <div class="tab-content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {tabs: []};
        },

        created() {
            this.tabs = this.$children;
        },

        methods: {
            selectTab(selectedTab) {
                this.tabs.forEach(tab => {
                    tab.isActive = (tab.href === selectedTab.href);
                });
            }
        }
    }
</script>