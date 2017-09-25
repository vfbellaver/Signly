<template>
    <div>
        <box>
            <box-title>
                Billboard Faces
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
							<th>Unique</th>
							<th>Height</th>
							<th>Width</th>
							<th>Monthly Impressions</th>
							<th>Duration</th>
							<th>Billboard</th>
                        </tr>
                        </thead>
                        <tbody>
                         <tr v-for="( billboardface, index ) in billboardFaces">
                            <td>{{ index + 1 }}</td>
							<td>{{ billboardface.unique.name }}</td>
							<td>{{ billboardface.height }}</td>
							<td>{{ billboardface.width }}</td>
							<td>{{ billboardface.monthly_impressions }}</td>
							<td>{{ billboardface.duration }}</td>
							<td>{{ billboardface.billboard.name }}</td>
                            <td>
                                <btn-success
                                    size="xs"
                                    @click.native="edit(billboardface)"
                                >
                                    <icon icon="edit"/>
                                </btn-success>

                                <btn-danger @click.native="destroy(billboardface)"
                                            :disabled="billboardface.destroyForm.busy"
                                            size="xs"
                                >
                                    <spinner v-if="billboardface.destroyForm.busy"></spinner>
                                    <icon icon="trash" v-else/>
                                </btn-danger>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </box-content>
        </box>
        <billboard-face-form ref="form" @saved="formSaved"></billboard-face-form>
    </div>
</template>

<script>
    import BillboardFaceForm from './billboard-face-form';

    export default {
        components:{
            BillboardFaceForm
        },
        data() {
            return {
                billboardFaces: []
            }
        },

        mounted() {
            this.reload();
        },

        methods: {

            add() {
                this.$refs.form.show();
            },

            edit(billboardFace) {
                this.$refs.form.show(billboardFace);
            },

            reload() {
                let self = this;
                Slc.get(laroute.route('api.billboard-face.index'))
                    .then((response) => {
                        self.billboardFaces = response;
                    });
            },

            formSaved(billboardFace) {
                let index = this.findIndex(billboardFace);
                index > -1 ? this.billboardFaces[index] = billboardFace : this.billboardFaces.push(billboardFace);
                this.$forceUpdate();
            },

            destroy(billboardFace) {
                let self = this;
                Slc.delete(laroute.route('api.billboard-face.destroy', {billboardFace: billboardFace.id}), billboardFace.destroyForm)
                    .then(() => {
                        self.removeBillboardFace(billboardFace);
                    });
            },

            removeBillboardFace(billboardFace) {
                this.billboardFaces.splice(this.findIndex(billboardFace), 1);
            },

            findIndex(billboardFace) {
                return this.billboardFaces.findIndex((_billboardFace) => {
                    return _billboardFace.id === billboardFace.id;
                });
            }
        }

    }

</script>