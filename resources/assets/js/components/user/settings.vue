<template>
    <div>
        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>

        <nav class="navbar navbar-in-content navbar-default" data-spy="affix" data-offset-top="147">
            <ul class="nav navbar-nav navbar-right"></ul>
        </nav>

        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <h1>Profile Settings</h1>
                        <div class="tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab-user-profile" aria-expanded="true">
                                        <i class="fa fa-fw fa-btn fa-edit"></i>
                                        User profile
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-security" aria-expanded="false">
                                        <i class="fa fa-fw fa-btn fa-lock"></i>
                                        Security
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-user-profile" class="tab-pane active">
                                    <div class="panel-body">
                                        <ul>
                                            <tab-user-settings></tab-user-settings>
                                        </ul>
                                    </div>
                                </div>
                                <div id="tab-security" class="tab-pane">
                                    <div class="panel-body">
                                        <ul>
                                            <tab-update-password></tab-update-password>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped="scoped">

    .tabs-container .tabs-left >
    .nav-tabs .active > a, .tabs-container
    .tabs-left > .nav-tabs .active > a:hover,
    .tabs-container .tabs-left > .nav-tabs
    .active > a:focus {
        border-left: 4px solid #53abd3;
        background-color: white;
    }

    .tabs-container .tabs-left
    .tab-pane .panel-body,
    .tabs-container .tabs-right
    .tab-pane .panel-body {
        border-top: 1px solid #f3f3f5;
        border-color: #f3f3f5;
        background-color: #f3f3f5;

    }
</style>
<script>
    import TabUserSettings from './tab-user-settings';
    import TabUpdatePassword from './tab-user-password';
    export default {
        components: {
            TabUserSettings,
            TabUpdatePassword,
        },
        data() {
            return {
                pageHeading: {
                    title: 'User Settings',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')}
                    ]
                },
            }
        },
    }
</script>