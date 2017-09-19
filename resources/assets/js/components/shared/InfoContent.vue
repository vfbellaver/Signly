







<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Name: {{name}}
        </div>
        <div class="panel-body">Description : {{description}} </div>
        <div class="panel-footer">Address : {{address}} </div>
    </div>
</template>

<script>

    export default {

        props: {

            name:{
              required:true,
            },

            description:{
                required:true,
            },

            address:{
                required:true,
            }
        },

        data() {
            return {
               xy: 'aqui foi o data'
            }
        },



        created() {

            const self = this;

            Bus.$on('markerChanged', (pos) => {
                self.form.lat = pos.lat;
                self.form.lng = pos.lng;
            });

            Bus.$on('addressChanged', (address) => {
                self.form.address = address;
            });

            Bus.$on('initialPosition', (self.form.lat, self.form.lat));
        },

        computed: {

            cd () {
              return this.aB.toUpperCase();
            }
        },

        methods: {
            buildForm(billboard) {
                return new SlcForm({
                    id: billboard ? billboard.id : null,
                    name: billboard ? billboard.name : null,
                    description: billboard ? billboard.description : null,
                    digital_driveby: billboard ? billboard.digital_driveby : null,
                    address: billboard ? billboard.address : null,
                    lat: billboard ? billboard.lat : null,
                    lng: billboard ? billboard.lng : null,
                });
            },

        }
    }
</script>