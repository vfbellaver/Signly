<template>
    <div class="row">
      <tabs>
          <tab name="User Settings" :selected="true">
              <form-user :user="user"></form-user>
          </tab>
          <tab name="Update payment Method">
              <card-user :user="user"></card-user>
          </tab>
          <tab name="Update Subscription">
              <subscription-user :user="user"></subscription-user>
          </tab>
          <tab name="Update Password">
              <password-user :user="user"></password-user>
          </tab>
      </tabs>
    </div>
</template>

<script>

    import Tabs from './tabs';
    import Tab from './tab';
    import FormUser from './user-formR';
    import CardUser from './user-card';
    import SubscriptionUser from './subscription-user';
    import PasswordUser from './password-user';

    export default {

        data(){
            return {
                user: Slc.user,
                stripe: Slc.stripeKey
            }
        },

        components:{
            Tab,
            Tabs,
            FormUser,
            CardUser,
            SubscriptionUser,
            PasswordUser
        },

        computed:{

        },


    }
</script>