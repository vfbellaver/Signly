<template>
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Detail</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">

                            <image-upload v-model="photoUrl" id="photo" name="photo"></image-upload>

                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong>{{user.name}}</strong></h4>
                        <p>{{user.team.name}}</p>

                        <div class="row m-t-lg">
                            <div class="col-md-4">

                                <h5><strong>169</strong> Posts</h5>
                            </div>
                            <div class="col-md-4">


                                <h5><strong>28</strong> Following</h5>
                            </div>
                            <div class="col-md-4">

                                <h5><strong>240</strong> Followers</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">

                           <user-menu></user-menu>

                </div>
            </div>

        </div>
    </div>
</template>

<style lang="scss" scoped="scoped">

</style>

<script>

    import UserMenu from './user-menu';

    export default {

        data() {
            return {
                user: Slc.user,
                photoUrl: null,
            }
        },

        components:{
            UserMenu
        },

        watch: {
            photoUrl(value, oldValue) {
                if (!oldValue) {
                    return;
                }
                this.$nextTick(() => {
                    this.updatePhoto();
                });
            },
        },
        created(){
            this.photoUrl = this.user.photo_url;
        },

        methods: {
            updatePhoto() {
                const uri = laroute.route('api.user.update.photo', {user: this.user.id});
                Slc.put(uri, new SlcForm({photo_url: this.photoUrl})).then((response) => {
                    console.log("Photo saved", response);
                    EventBus.$emit('userUpdated');
                })
            },
        }
    }

</script>