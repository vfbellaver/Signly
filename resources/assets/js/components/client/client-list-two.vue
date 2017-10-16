<template>
    <div class="client-list">
        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>

        <nav class="navbar navbar-in-content navbar-default" data-spy="affix" data-offset-top="147">
            <ul class="nav navbar-nav navbar-right">
                <li><a @click="add">
                    <icon icon="plus"></icon>
                    Add</a></li>
                <li><a @click="importClient">
                    <icon icon="upload"></icon>
                    Import</a></li>
            </ul>
        </nav>

        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <div class="ibox-content">

                    <div class="table-responsive">

                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="dataTables_length">
                                <label> Show </label>
                                    <select name="DataTables_Table_0_length" class="form-control input-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                            </div>

                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                <label>Search:</label>
                                <input type="search" class="form-control input-sm" placeholder="search">
                            </div>

                            <div class="dataTables_info">
                                Showing 1 to 10 of 57 entries
                            </div>

                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable"
                                   id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Company Name</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="( client, index ) in clients">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ client.company_name }}</td>
                                        <td>{{ client.first_name }}</td>
                                        <td>{{ client.last_name }}</td>
                                        <td>{{ client.email }}</td>
                                        <td>
                                            <btn-success
                                                    size="xs"
                                                    @click.native="edit(client)"
                                            >
                                                <icon icon="edit"/>
                                            </btn-success>

                                            <btn-danger @click.native="destroy(client)"
                                                        :disabled="client.destroyForm.busy"
                                                        size="xs"
                                            >
                                                <spinner v-if="client.destroyForm.busy"></spinner>
                                                <icon icon="trash" v-else/>
                                            </btn-danger>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </table>
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button previous disabled" id="DataTables_Table_0_previous">
                                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0">Previous</a>
                                    </li>
                                    <li class="paginate_button active"><a href="#"
                                                                          aria-controls="DataTables_Table_0"
                                                                          data-dt-idx="1" tabindex="0">1</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0"
                                                                    data-dt-idx="2" tabindex="0">2</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0"
                                                                    data-dt-idx="3" tabindex="0">3</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0"
                                                                    data-dt-idx="4" tabindex="0">4</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0"
                                                                    data-dt-idx="5" tabindex="0">5</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0"
                                                                    data-dt-idx="6" tabindex="0">6</a></li>
                                    <li class="paginate_button next" id="DataTables_Table_0_next"><a href="#"
                                                                                                     aria-controls="DataTables_Table_0"
                                                                                                     data-dt-idx="7"
                                                                                                     tabindex="0">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <client-form @saved="formSaved" ref="form"></client-form>
        <client-import-form ref="importForm" @saved="reload"></client-import-form>
    </div>
</template>

<script>
    import ClientForm from './client-form';
    import ClientImportForm from './client-import-form';

    export default {
        components: {
            ClientForm,
            ClientImportForm
        },
        data() {
            return {
                clients: [],
                pageHeading: {
                    title: 'Client List',
                    breadcrumb: [
                        {title: 'Home', url: laroute.route('home')}
                    ]
                },
            }
        },

        mounted() {
            this.reload();
        },

        methods: {
            add() {
                this.$refs.form.show();
            },

            importClient(){
                this.$refs.importForm.show();
            },

            edit(client) {
                this.$refs.form.show(client);
            },

            reload() {
                let self = this;
                Slc.get(laroute.route('api.client.index'))
                    .then((response) => {
                        self.clients = response;
                    });
            },

            formSaved(client) {
                let index = this.findIndex(client);
                index > -1 ? this.clients[index] = client : this.clients.push(client);
                this.$forceUpdate();
            },

            destroy(client) {
                let self = this;
                Slc.delete(laroute.route('api.client.destroy', {client: client.id}), client.destroyForm)
                    .then(() => {
                        self.removeClient(client);
                    });
            },

            removeClient(client) {
                this.clients.splice(this.findIndex(client), 1);
            },

            findIndex(client) {
                return this.clients.findIndex((_client) => {
                    return _client.id === client.id;
                });
            }
        }

    }

</script>