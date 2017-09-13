<template>
    <div>
        <box>
            <box-title>
                Clients
                <box-tools slot="tools">
                    <box-tool icon="plus" @click.native="add">New</box-tool>
                </box-tools>
            </box-title>
            <box-content>
                <div class="table-responsive">
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
                </div>
            </box-content>
        </box>
        <client-form ref="form" @saved="formSaved"></client-form>
    </div>
</template>

<script>
    import ClientForm from './client-form';

    export default {
        components:{
            ClientForm
        },
        data() {
            return {
                clients: []
            }
        },

        mounted() {
            this.reload();
        },

        methods: {

            add() {
                this.$refs.form.show();
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