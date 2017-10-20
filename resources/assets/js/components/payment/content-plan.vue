<template>
    <div>
        <div class="col-lg-3">
            <div class="register-box">
                <div class="text-center">
                    <div :class="footer">
                        <h2><strong>14 DAYS</strong></h2>
                    </div>
                    <h3>TRIAL</h3>
                </div>
                <div :class="circle">
                    <i :class="icon" aria-hidden="true"></i>
                </div>
                <div class="text-center">
                    <h1>
                        <small>PLAN</small>
                    </h1>
                    <h3>{{name}}</h3>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {required: true},
            icon: {required: true},
            circle: {required: true},
            footer: {required: true},
        },

    }
</script>