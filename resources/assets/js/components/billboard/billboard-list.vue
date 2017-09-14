<template>
    <div>
        <box>
            <box-title>
                Billboards
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
							<th>Name</th>
							<th>Address</th>
							<th>Lat</th>
							<th>Lng</th>
                        </tr>
                        </thead>
                        <tbody>
                         <tr v-for="( billboard, index ) in billboards">
                            <td>{{ index + 1 }}</td>
							<td>{{ billboard.name }}</td>
							<td>{{ billboard.lat }}</td>
							<td>{{ billboard.lng }}</td>
                            <td>
                                <btn-success
                                    size="xs"
                                    @click.native="edit(billboard)"
                                >
                                    <icon icon="edit"/>
                                </btn-success>

                                <btn-danger @click.native="destroy(billboard)"
                                            :disabled="billboard.destroyForm.busy"
                                            size="xs"
                                >
                                    <spinner v-if="billboard.destroyForm.busy"></spinner>
                                    <icon icon="trash" v-else/>
                                </btn-danger>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </box-content>
        </box>
        <billboard-form ref="form" @saved="formSaved"></billboard-form>
    </div>
</template>

<script>
    import BillboardForm from './billboard-form';

    export default {
        components:{
            BillboardForm
        },
        data() {
            return {
                billboards: []
            }
        },

        mounted() {
            this.reload();
        },

        methods: {

            add() {
                this.$refs.form.show();
            },


            edit(billboard) {
                this.$refs.form.show(billboard);
            },

            reload() {
                let self = this;
                Slc.get(laroute.route('api.billboard.index'))
                    .then((response) => {
                        self.billboards = response;
                    });
            },

            formSaved(billboard) {
                let index = this.findIndex(billboard);
                index > -1 ? this.billboards[index] = billboard : this.billboards.push(billboard);
                this.$forceUpdate();
            },

            destroy(billboard) {
                let self = this;
                Slc.delete(laroute.route('api.billboard.destroy', {billboard: billboard.id}), billboard.destroyForm)
                    .then(() => {
                        self.removeBillboard(billboard);
                    });
            },

            removeBillboard(billboard) {
                this.billboards.splice(this.findIndex(billboard), 1);
            },

            findIndex(billboard) {
                return this.billboards.findIndex((_billboard) => {
                    return _billboard.id === billboard.id;
                });
            }
        }

    }

</script>