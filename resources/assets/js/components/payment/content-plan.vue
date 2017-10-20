<template>
    <div>
        <div class="col-lg-4">
            <div class="register-box">
                <div class="register-circulo">
                    <i class="fa fa-handshake-o" aria-hidden="true"></i>
                </div>
                <hr>
                <div class="text-center">
                    <h1>
                        <small>PLAN</small>
                    </h1>
                    <h2>{{name}}</h2>

                </div>
            </div>
            <div class="register-footer">
                <h1>{{value}}</h1>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
       props:{
           name:{required:true},
           value:{required:true},
       }
    }
</script>