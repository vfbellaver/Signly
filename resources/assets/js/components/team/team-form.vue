<template>
    <div>
        <form-submit v-model="team" @submit="saveTeam">
            <column size="4">
                <h3>Profile photo:</h3>
                <hr>
                <form-group :form="team" field="logo">
                    <image-upload v-model="team.logo" id="logo"
                                  name="logo"></image-upload>
                </form-group>
                <hr>
            </column>

            <column size="8">
                <h3>Team Information</h3>
                <hr>

                <form-group :form="team" field="name">
                    <input-label for="name">Name: </input-label>
                    <input-text v-model="team.name" id="name"
                                name="name"></input-text>
                </form-group>
                <hr>
                <div>
                    <btn-submit class="pull-right">
                        <spinner v-if="team.busy"></spinner>
                        <span> UPDATE TEAM</span>
                    </btn-submit>
                </div>
                <div>
                </div>
            </column>
        </form-submit>
    </div>
</template>
<style lang="scss" scoped="scoped">

    hr {
        border-bottom: solid 4px #43A3D0;
    }
</style>
<script>

    import * as SLC from '../../vue/http'

    export default {
        data() {
            return {
                team: Slc.user.team,
            }
        },

        created(){
            this.buildForm();
        },

        methods: {
           saveTeam(){
             const self = this;
             const uri = laroute.route('api.team.update',{team: this.team.id});
             SLC.put(uri,self.team).then((response) => {
                console.log('Team updated ',response);
             });
           },

           buildForm(){
               this.team = new SlcForm({
                   id: this.team.id,
                   logo: this.team.logo ? this.team.logo : null ,
                   name: this.team.name,
               });
           },
        }
    }
</script>