<template>
    <div>
        <box>
            <box-title>
                Teams
                <box-tools slot="tools">
                    <box-tool icon="plus" @click.native="add">New</box-tool>
                </box-tools>
            </box-title>
            <box-content>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="( team, index ) in teams">
                            <td>{{ index + 1 }}</td>
                            <td>{{team.name}}</td>
                            <td>
                                <btn-success
                                        size="xs"
                                        @click.native="edit(team)"
                                >
                                    <icon icon="edit"/>
                                </btn-success>

                                <btn-danger @click.native="destroy(team)"
                                            :disabled="team.destroyForm.busy"
                                            size="xs"
                                >
                                    <spinner v-if="team.destroyForm.busy"></spinner>
                                    <icon icon="trash" v-else/>
                                </btn-danger>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </box-content>
        </box>
        <team-form ref="form" @saved="formSaved"></team-form>
    </div>
</template>

<script>
    import TeamForm from './team-form';

    export default {
        components: {
            TeamForm
        },
        data() {
            return {
                teams: []
            }
        },

        mounted() {
            this.reload();
        },

        methods: {

            add() {
                this.$refs.form.show();
            },

            edit(team) {
                this.$refs.form.show(team);
            },

            reload() {
                Slc.get(laroute.route('api.team.index'))
                    .then((response) => {
                        this.teams = response;
                    });
            },

            formSaved(team) {
                let index = this.findIndex(team);
                index > -1 ? this.teams[index] = team : this.teams.push(team);
                this.$forceUpdate();
            },

            destroy(team) {
                let self = this;
                Slc.delete(laroute.route('api.team.destroy', {team: team.id}), team.destroyForm)
                    .then(() => {
                        self.removeTeam(team);
                    });
            },

            removeTeam(team) {
                this.teams.splice(this.findIndex(team), 1);
            },

            findIndex(team) {
                return this.teams.findIndex((_team) => {
                    return _team.id === team.id;
                });
            }
        }

    }

</script>