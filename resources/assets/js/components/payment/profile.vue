<template>
    <div>
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile</h5>
                </div>
                <div class="ibox-content">
                    <div class="col-lg-10 col-lg-offset-1">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <div class="col-lg-2">
                                    <label>Team</label>
                                </div>
                                <select>

                                </select>
                            </div>
                        </form>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TeamSelect from '../team/team-select';
    export default {

        components:{
           TeamSelect,
        },

        data(){

            return {
                key: window.Slc.StripeKey,
                stripe: null,
            }
        },

       created(){
            this.stripe = StripeElements.configure({

            });
            console.log(this.key);
       }
    }
</script>