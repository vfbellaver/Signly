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
                        <h1>Company Settings</h1>
                        <div class="tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab-team-profile" aria-expanded="true">
                                        <i class="fa fa-fw fa-btn fa-edit"></i>
                                        Team profile
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-membership" aria-expanded="false">
                                        <i class="fa fa-fw fa-btn fa-users"></i>
                                        Membership
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-subscription" aria-expanded="true">
                                        <i class="fa fa-fw fa-btn fa-shopping-bag"></i>
                                        Subscription
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-payment-method" aria-expanded="false">
                                        <i class="fa fa-fw fa-btn fa-credit-card"></i>
                                        Payment method
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-invoices" aria-expanded="false">
                                        <i class="fa fa-fw fa-btn fa-history"></i>
                                        Invoices
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-configuration" aria-expanded="true">
                                        <i class="fa fa-fw fa-btn fa-gears"></i>
                                        Configuration
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content ">
                                <div id="tab-team-profile" class="tab-pane active">
                                    <div class="panel-body">
                                        <ul>
                                            <team-form></team-form>
                                        </ul>
                                    </div>
                                </div>
                                <div id="tab-membership" class="tab-pane">
                                    <div class="panel-body">
                                        <ul>
                                            <team-membership></team-membership>
                                            <team-list></team-list>
                                        </ul>
                                    </div>
                                </div>
                                <div id="tab-subscription" class="tab-pane">
                                    <div class="panel-body">
                                        <ul>
                                            <li>Update subscription (change plan)</li>
                                            <li>Cancel subscription</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="tab-payment-method" class="tab-pane">
                                    <div class="panel-body">
                                        <ul>
                                            <li>Show current card</li>
                                            <li>Update Payment Method (credit card)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="tab-invoices" class="tab-pane">
                                    <div class="panel-body">
                                        <ul>
                                            <li>Show invoices</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="tab-configuration" class="tab-pane">
                                    <div class="panel-body">
                                        <ul>
                                            <li>Default Map Center</li>
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
<style>

</style>
<script>
    import TeamMembership from './team-membership';
    import TeamList from './team-list';
    import TeamForm from './team-form';
    export default {

        components: {
            TeamMembership,
            TeamList,
            TeamForm,
        },

        data() {
            return {
                pageHeading: {
                    title: 'Company Settings',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')}
                    ]
                },
            }
        }
    }
</script>