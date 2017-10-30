<template>
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li v-for="tab in tabs" @click="selectTab(tab)" :class="{'active' : tab.isActive}"><a>{{tab.name}}</a></li>
                    </ul>
                    <div class="tab-pane">
                        <div class="panel-body">
                            <slot></slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {

        props:{

        },

        data(){
           return{
               tabs:[]
           }
        },

        computed:{

        },

        methods:{
            selectTab(selectedTab){

                this.tabs.forEach(tab => {
                    tab.isActive = (tab.name == selectedTab.name);
                });
            }
        },

        created(){
          this.tabs = this.$children;
        },

    }
</script>