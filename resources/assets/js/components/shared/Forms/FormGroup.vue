<template>
    <div class="form-group" :class="{'has-error': form.errors.has( field )}">
        <slot></slot>
        <span :class="'help-block' + (horizontal ? ' col-md-offset-4' : '')" v-show="form.errors.has( field )">
            {{ form.errors.get(field) }}
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            form      : {
                type    : Object,
                required: true
            },
            field     : {
                type    : String,
                required: true
            },
            horizontal: {
                required: false,
                default : false
            }
        }
    }
</script>