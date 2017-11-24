<template>

    <div class="proposal-list">
        <inspinia-page-heading v-if="pageHeading" :data="pageHeading"></inspinia-page-heading>

        <nav class="navbar navbar-in-content navbar-default" data-spy="affix" data-offset-top="147">
            <ul class="nav navbar-nav navbar-right">
                <li><a @click="add">
                    <icon icon="plus"></icon>
                    Add</a></li>
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
                                    <th>Client</th>
                                    <th>Time Range</th>
                                    <th>Total Price</th>
                                    <th style="width: 72px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="( proposal, index ) in proposals">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ proposal.name }}</td>
                                    <td>{{ proposal.client.company_name }}</td>
                                    <td> {{proposal.from_date | date('MM/DD/YYYY')}} - {{proposal.to_date | date('MM/DD/YYYY')}}</td>
                                    <td>{{ "$"+  total(proposal) }}</td>
                                    <td>
                                        <btn-success size="xs" @click.native="edit(proposal)"
                                                     :disabled="proposal.editForm.busy">
                                            <spinner v-if="proposal.editForm.busy"></spinner>
                                            <icon v-else icon="edit"></icon>
                                        </btn-success>

                                        <btn-danger @click.native="destroy(proposal)"
                                                    :disabled="proposal.destroyForm.busy"
                                                    size="xs">
                                            <spinner v-if="proposal.destroyForm.busy"></spinner>
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

        <proposal-form ref="form" @saved="formSaved"></proposal-form>
    </div>

</template>

<script>
    import ProposalForm from './proposal-form';

    export default {
        components: {
            ProposalForm
        },
        data() {
            return {
                proposals: [],
                pageHeading: {
                    title: 'Proposal List',
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

            edit(proposal) {
                proposal.editForm.busy = true;
                window.location = laroute.route('proposals.show', {proposal: proposal.id});
            },

            reload() {
                let self = this;
                Slc.get(laroute.route('api.proposal.index'))
                    .then((response) => {
                        self.proposals = response;
                    });
            },

            formSaved(proposal) {
                let index = this.findIndex(proposal);
                index > -1 ? this.proposals[index] = proposal : this.proposals.push(proposal);
                this.$forceUpdate();
                window.location = laroute.route('proposals.show', {proposal: proposal.id});
            },

            destroy(proposal) {
                let self = this;
                Slc.delete(laroute.route('api.proposal.destroy', {proposal: proposal.id}), proposal.destroyForm)
                    .then(() => {
                        self.removeProposal(proposal);
                    });
            },

            removeProposal(proposal) {
                this.proposals.splice(this.findIndex(proposal), 1);
            },

            findIndex(proposal) {
                return this.proposals.findIndex((_proposal) => {
                    return _proposal.id === proposal.id;
                });
            },
            total(proposal) {
                if (!proposal.billboard_faces) {
                    return 0;
                }
                const faces = proposal.billboard_faces;
                let total = 0;
                for (let i = 0; i < faces.length; i++) {
                    const f = faces[i];
                    total += Number.parseFloat(f.pivot.price);
                }
                console.log("Total", total);
                return total.toFixed(2);
            },
        }

    }

</script>