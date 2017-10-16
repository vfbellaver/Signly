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
                            <small>{{face.notes}}</small>
                            <hr>
                            <div>
                                <div class="col-md-6">
                                    <p>Monthly Impressions</p>
                                    <h1>{{face.monthly_impressions}}</h1>
                                </div>
                                <div>
                                    <p>Hard Cost</p>
                                    <h1 class="product-main-price">$ {{formatMoney(face.hard_cost)}}</h1>
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
                                    <td>{{face.is_illuminated}}</td>
                                    <td>{{face.lights_on}}</td>
                                    <td>{{face.lights_off}}</td>
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
    .img {
        max-width: 100%;
    }
</style>

<script>

    import _ from 'lodash';
    import * as Slc from "../../vue/http";

    export default {
        props: {
            billboardId: {required: false},
        },

        components: {},

        data() {
            return {
                billboardFaces: [],
            }
        },

        mounted() {
            this.reload();
        },

        mounted() {
            this.reload();
        },

        methods: {
            reload() {
                let self = this;
                Slc.get(laroute.route('api.billboard-face.index', {bid: this.billboardId}))
                    .then((response) => {
                        self.billboardFaces = response;
                    });
            },

            formatMoney(money){

                let v = money;
                v = v.toString().replace(/[^0-9]/g, "");
                if (v === undefined || v === null || v.length === 0) {
                    return "";
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
            }

        }
    }
</script>