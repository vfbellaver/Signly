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
                            <th style="width: 50px"></th>
                            <th>Name</th>
                            <th style="width: 200px" class="hidden-sm">Address</th>
                            <th style="width: 100px">Driveby</th>
                            <th style="width: 100px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="( billboard, index ) in billboards">
                            <td>{{ index + 1 }}</td>
                            <td>{{ billboard.name }}</td>
                            <td class="hidden-sm">{{ billboard.address }}</td>
                            <td>{{ billboard.digital_driveby }}</td>
                            <td>
                                <btn-success size="xs" @click.native="edit(billboard)">
                                    <icon icon="edit"></icon>
                                </btn-success>
                                <btn-danger @click.native="destroy(billboard)"
                                            :disabled="billboard.destroyForm.busy"
                                            size="xs">
                                    <spinner v-if="billboard.destroyForm.busy"></spinner>
                                    <icon icon="trash" v-else></icon>
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
        components: {
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