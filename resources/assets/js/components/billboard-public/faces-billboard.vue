<template>
    <div>
        <div v-for="face in billboardFaces">
            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Billboard Face Description</h3>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right">
                            <img alt="image" class="img" :src="face.photo" width="100%">
                        </div>

                        <div class="ibox-content profile-content">
                            <row>
                                <h2 class="font-bold m-b-xs col-md-6">
                                    Billboard Face - {{face.label}}
                                </h2>

                                <h2 class="font-bold m-b-xs">
                                    Code - {{face.code}}
                                </h2>
                            </row>
                            <div class="notes">
                                <small>{{face.notes}}</small>
                            </div>
                            <hr>
                            <div>
                                <div class="col-md-6">
                                    <p>Monthly Impressions</p>
                                    <h1>{{face.monthly_impressions}}</h1>
                                </div>
                                <div>
                                    <p>Hard Cost</p>
                                    <h1 class="product-main-price">$ {{formatMoney(face.rate_card)}}</h1>
                                </div>
                            </div>
                            <hr>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Width</th>
                                    <th>Height</th>
                                    <th>Type</th>
                                    <th>Duration</th>
                                    <th>Illuminated</th>
                                    <th>Lights on</th>
                                    <th>Lights off</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{face.width}}</td>
                                    <td>{{face.height}}</td>
                                    <td>{{face.type}}</td>
                                    <td>{{face.duration}}</td>
                                    <td>{{(face.is_illuminated ? 'Yes' : 'No')}}</td>
                                    <td>{{format(face.lights_on)}}</td>
                                    <td>{{format(face.lights_off)}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</template>
<style lang="scss" scoped="scoped">
    .notes{
        min-height: 70px;
    }
</style>
<script>

    import _ from 'lodash';
    import * as Slc from "../../vue/http";

    export default {
        props: {
            billboardId: {required: true},
        },

        components: {},

        data() {
            return {
                billboardFaces: [],
            }
        },

        mounted() {
            this.load();
        },

        methods: {
            load() {

                const self = this;
                const uri = laroute.route('public.get.faces', {bid: this.billboardId});
                Slc.get(uri).then((response) => {
                    console.log('Load Faces - ',response);
                        self.billboardFaces = response;

                    });
            },

            formatMoney(money){

                let v = money;
                v = v.toString().replace(/[^0-9]/g, "");
                if (v === undefined || v === null || v.length === 0) {return "";
                }

                v = v.replace(/^0*/g, "");
                v = v.replace(/^$/, "0.00");
                v = v.replace(/^(\d)$/, "0.0$1");
                v = v.replace(/^(\d{2})$/, "0.$1");
                v = v.replace(/(\d+)(\d{2})$/, "$1.$2");
                for (let i = 0; i < 10; i++) {
                    v = v.replace(/(\d)(\d{3}[.,])/, "$1,$2");
                }
                return v;
            },

            format(hour){
                if (hour) {
                    console.log('Format Hour - ', hour);
                    const m = moment(hour, 'HH:mm:ss');
                    return m.format('LT');

                }
            }


        }
    }
</script>