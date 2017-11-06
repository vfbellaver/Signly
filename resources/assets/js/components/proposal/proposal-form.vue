<template>
    <div>
        <slider>
            <h2>Proposal</h2>
            <form-submit v-model="proposal" @submit="saveProposal">
                <form-group :form="proposal" field="client">
                    <input-label for="client">Client: </input-label>
                    <client-select v-model="proposal.client" id="client" name="client"/>
                </form-group>
            </form-submit>
        </slider>
    </div>
</template>

<style>

</style>

<script>

    import ClientSelect from '../client/client-select';
    import SLC from '../../vue/http';

    export default {

        props: {},

        components: {
            ClientSelect,
        },

        data(){

            return {
                proposal: null,
            }
        },

        created(){
            this.proposal = new SlcForm({
                team_id: Slc.user.team.id,
                client: '',
            });
        },

        mounted(){
            Bus.$on('add-face', (face) => console.log('Face', face));
        },

        methods:{

            saveProposal(){

            },
        }

    }

</script>