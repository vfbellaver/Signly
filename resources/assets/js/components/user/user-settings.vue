<template>
    <div>
        <box>
            <box-title>
                Profile
            </box-title>
            <box-body>
                <column size="4">
                    <user-side-bar></user-side-bar>
                </column>
                <column size="8">
                    <user-dashboard></user-dashboard>
                </column>
            </box-body>
        </box>
    </div>
</template>

<script>
    import UserSideBar from './user-side-bar';
    import UserDashboard from './user-dashboard.vue';
    export default {
        components: {
            UserSideBar,
            UserDashboard
        },
        data() {
            return {
            }
        },
        methods: {
        }
    }
</script>