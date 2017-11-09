<template>
    <div class="contact-box">
        <a :href="contact.url">
            <div class="col-sm-4">
                <div class="text-center">
                    <img alt="image" class="img-circle m-t-xs img-responsive" :src="contact.image">
                    <div class="m-t-xs font-bold">{{contact.imageTitle}}</div>
                </div>
            </div>
            <div class="col-sm-8">
                <h3><strong>{{contact.name}}</strong></h3>
                <p><i class="fa fa-map-marker"></i> {{contact.location}}</p>
                <address>
                    <strong>{{contact.companyName}}</strong><br>
                    <span v-if="contact.company.address_line1">{{contact.company.address_line1}}<br></span>
                    <span v-if="contact.company.address_line2">{{contact.company.address_line2}}<br></span>
                    <span>{{contact.company.city}}, {{contact.company.state}} {{contact.company.zipcode}}<br></span>
                    <abbr title="Phone">P:</abbr> {{contact.phone}}
                </address>
            </div>
            <div class="clearfix"></div>
        </a>
    </div>
</template>

<style>

</style>

<script>
    export default {
        props: {
            contact: {required: true}
        }
    }
</script>