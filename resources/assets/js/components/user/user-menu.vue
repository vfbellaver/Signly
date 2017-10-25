<template>
    <div class="row">
      <tabs>
          <tab name="User Settings" :selected="true">
              <form-user :user="user"></form-user>
          </tab>
          <tab name="User Subscription">
              <card-user :user="user"></card-user>
          </tab>
      </tabs>
    </div>
</template>

<script>

    import Tabs from './tabs';
    import Tab from './tab';
    import FormUser from './user-formR';
    import CardUser from './user-card';

    export default {

        data(){
            return {
                user: Slc.user
            }
        },

        components:{
            Tab,
            Tabs,
            FormUser,
            CardUser,
        },

        computed:{

        },


    }
</script>