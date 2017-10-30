<template>
    <li class="dropdown">
        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope"></i>
            <span class="label label-danger" v-if="this.notifications.length != 0">{{this.notifications.length}}</span>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <div v-if="this.notifications.length === 0">
                <div class="dropdown-messages-box">
                    <div class="text-center">
                        <strong>You don't have notifications!</strong>
                    </div>
                    <div class="divider"></div>
                </div>
            </div>
            <div style="overflow: auto; max-height: 400px">
                <li v-for="msg in notifications">
                    <div class="dropdown-messages-box">
                        <div class="media-body">
                            <small class="pull-right">{{format(msg.created_at)}}</small>
                            <strong>Subject:</strong> {{msg.subject}}. <br>
                            <strong>Message:</strong><br>
                            <p class="text-justify">{{msg.message}}</p>
                            <a class="btn btn-xs btn-primary pull-right" @click="readMsg(msg)">
                                Read <i class="fa fa-check-square-o"></i>
                            </a>
                        </div>
                        <div class="divider"></div>
                    </div>
                </li>
            </div>
        </ul>
    </li>
</template>
<style lang="scss" scoped="scoped">
    .dropdown-messages {
        min-width: 500px;

    }

    .dropdown-messages-box {
        padding-right: 10px;
    }

</style>
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
                const uri = laroute.route('api.message.update', {message: msg.id});
                Slc.put(uri, new SlcForm({visualized: true})).then((response) => {
                    console.log("Message Read", response);
                    this.load();
                })
            },
            format(d){
                console.log('data - ', d.date);
                const m = moment(d.date);
                return m.format('LLL')
            }
        }
    }
</script>