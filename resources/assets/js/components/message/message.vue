<template>
    <li class="dropdown">
        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope"></i> <span class="label label-danger">{{this.notifications.length}}</span>
        </a>

        <ul class="dropdown-menu dropdown-messages">
            <div style="overflow: auto; max-height: 400px">
                <li v-for="msg in notifications">
                    <div class="ibox-content profile-content">
                        <h5><strong>Subject:</strong></h5>
                        <p>{{msg.subject}}</p>

                        <h5>Message:</h5>
                        <p class="text-justify">{{msg.message}}</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary btn-sm pull-right" @click="readMsg(msg)">
                                        <i class="fa fa-edit"></i>
                                        Mark a read
                                    </button>
                                </div>
                            </div>

                    </div>
                    <hr>
                </li>
            </div>
        </ul>
    </li>
</template>
<script>
    export default {
        props: {
            user: {required: true},
        },

        data(){
            return {
                form: new SlcForm({}),
                notifications: [],
            }
        },

        created() {
            this.load();
        },

        methods: {
            load(){
                let self = this;
                Slc.get(laroute.route('api.message.index', {uid: this.user.id}))
                    .then((response) => {
                        self.notifications = response;
                    });
            },
            readMsg(msg){
                const uri = laroute.route('api.message.update',{message: msg.id});
                Slc.put(uri, new SlcForm({visualized: true})).then((response) => {
                    console.log("Message Read", response);
                    this.load();
                })
            }
        }
    }
</script>