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
                <box>
                    <box-content>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 64px"></th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th style="width: 320px">Email</th>
                                    <th style="width: 72px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="( client, index ) in clients">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ client.company_name }}</td>
                                    <td>{{ client.first_name }} {{ client.last_name }}</td>
                                    <td>{{ client.email }}</td>
                                    <td>
                                        <btn-success
                                                size="xs"
                                                @click.native="edit(client)"
                                        >
                                            <icon icon="edit"></icon>
                                        </btn-success>

                                        <btn-danger @click.native="destroy(client)"
                                                    :disabled="client.destroyForm.busy"
                                                    size="xs"
                                        >
                                            <spinner v-if="client.destroyForm.busy"></spinner>
                                            <icon icon="trash" v-else></icon>
                                        </btn-danger>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </box-content>
                </box>
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

            importClient() {
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