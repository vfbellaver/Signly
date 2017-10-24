<template>
    <li class="dropdown">
        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope"></i>  <span class="label label-danger">{{this.messages.length}}</span>
        </a>
        <ul v-for="msg in this.messages" class="dropdown-menu dropdown-messages">
            <li>
                <div class="dropdown-messages-box">
                    <div>
                        <small><strong>Subject:</strong></small>
                        <h4 class="text-muted">{{msg.subject}}</h4>
                    </div>
                </div>
            </li>
            <li class="divider"></li>
        </ul>
    </li>
</template>
<script>
    export default {
        props:{
            messages: {required: true},
        },

        data(){
            return{

            }
        },

        mounted() {
            this.load();
        },

        methods: {
            load(){
                console.log('carreguei - ',this.messages);
                console.log('qntd - ',this.messages.length);
            }
        }
    }
</script>