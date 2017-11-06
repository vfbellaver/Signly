<template>
    <div class="zap-slideout"
         :class="{ isOpen: isOpen }">
        <div class="zap-slideout-opener" @click="toggle">
            <button type="button" class="btn btn-primary btn-circle btn-lg">
                <i :class="openerIcon" aria-hidden="true"></i>
            </button>
        </div>
        <div class="zap-slideout-menu">
          <slot></slot>
        </div>
    </div>
</template>
<script>

    export default{
        data(){
            return {
                openerIcon: 'fa fa-chevron-right',
                isOpen: false,
            }
        },

        components:{
        },

        methods: {

            open(){
                this.openerIcon = 'fa fa-chevron-left';
                this.isOpen = true;
            },

            close(){
                this.openerIcon = 'fa fa-chevron-right';
                this.isOpen = false;
            },

            toggle(){
              if(this.isOpen) {
                  this.close();
              } else {
                  this.open();
              }
            },
        },
    }
</script>