<template>
    <div class="zap-slideout"
         :class="{ isOpen: isOpen }">
        <div class="zap-slideout-opener"
             @click="toggle">{{openerText}}</div>
        <ul class="zap-slideout-menu">
            <li class="zap-slideout-menu-item">
                <img class="zap-emoji" src="/images/pin.png" />
            </li>
            <li class="zap-slideout-menu-item"
                v-for="item in menu">{{item}}</li>
            <li class="zap-slideout-menu-item--small"
                v-for="item in smallMenu">{{item}}</li>
        </ul>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                openerText: 'Open',
                isOpen: false,
                menu: ['Home', 'Work', 'Contact'],
                smallMenu: ['Tips', 'Resources', 'Shenanigans']
            }
        },

        methods: {

            open(){
                this.openerText = 'Close';
                this.isOpen = true;
            },

            close(){
                this.openerText = 'Open';
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