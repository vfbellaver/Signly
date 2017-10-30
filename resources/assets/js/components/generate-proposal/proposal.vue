<template>
    <div class="ibox-title">
        <div>
            <div>
                <h4>Select Client:</h4>
                <client-select :option="clients"></client-select>
            </div>
            <div class="ibox float-e-margins">
                <h5>Previous Proposals</h5>
                <div class="ibox-content row">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th><i class="fa fa-calendar"></i> Date Expiration</th>
                            <th><i class="fa fa-check-square-o"></i> Status</th>
                            <th><i class="fa fa-briefcase"></i> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>Status</td>
                            <td>
                                <div class="btn-group pull-right">
                                    <button data-v-c3cccd28="" class="btn btn-white btn-sm">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-white btn-sm">
                                        <i class="fa fa-trash"></i>
                                        Close
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>
                                <div class="btn-group pull-right">
                                    <button data-v-c3cccd28="" class="btn btn-white btn-sm">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-white btn-sm">
                                        <i class="fa fa-trash"></i>
                                        Close
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>
                                <div class="btn-group pull-right">
                                    <button data-v-c3cccd28="" class="btn btn-white btn-sm">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-white btn-sm">
                                        <i class="fa fa-trash"></i>
                                        Close
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="ibox-content row">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            team_id: {required: true}
        },
        data(){
            return {
                clients: [],
            }
        },

        mounted(){
            this.load();
        },

        methods: {
            load(){
                let self = this;
                Slc.get(laroute.route('api.client.index'))
                    .then((response) => {
                        debugger;
                        self.clients = response;
                    });
            },
        }
    }
</script>