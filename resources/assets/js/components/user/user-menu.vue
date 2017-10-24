<template>
    <div class="row">
      <tabs>
          <tab name="User Settings" :selected="true">
              <form-user :user="user"></form-user>
          </tab>
          <tab name="Invite a new Member">
              <h1>Invite a new Member</h1>
          </tab>
      </tabs>
    </div>
</template>

<script>

    import Tabs from './tabs';
    import Tab from './tab';
    import FormUser from './user-formR';

    export default {

        data(){
            return {
                user: Slc.user
            }
        },

        components:{
            Tab,
            Tabs,
            FormUser
        },

        computed:{

        },


    }
</script>