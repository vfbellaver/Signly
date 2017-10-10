<template>
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> This is tab</a></li>
            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">This is second tab</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                    <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

                    <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                        existence in this spot, which was created for the bliss of souls like mine.</p>

                    <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                        the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                </div>
            </div>
            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>
        </div>


    </div>
</template>

<style lang="scss" scoped="scoped">
    .ibox {
        margin-top: 0px;
        .ibox-title {
            margin-top: 0;
            border: 0;
            padding-top: 0;
            h5 {
                font-size: 13px;
                font-weight: bold;
                margin: 0;
            }
        }
        .ibox-content {
            border: 0;
        }

        > hr {
            margin: 5px;
        }

        h3 {
            small {
                padding-left: 12px;
            }
        }

    }
</style>

<script>

    import _ from 'lodash';
    import * as Slc from "../../vue/http";

    export default {
        props: {
            billboardId: {required: false},
        },

        components: {

        },

        data() {
            return {
                billboardFaces: [],
            }
        },

        computed: {},

        mounted() {
            this.reload();
        },

        methods: {

            add() {
                this.$refs.form.show();
            },
            edit(billboardFace) {
                this.$refs.form.show(billboardFace);
            },
            reload() {
                let self = this;
                Slc.get(laroute.route('api.billboard-face.index', {bid: this.billboardId}))
                    .then((response) => {
                        self.billboardFaces = response;
                    });
            },
            formSaved(billboardFace) {
                let index = this.findIndex(billboardFace);
                index > -1 ? this.billboardFaces[index] = billboardFace : this.billboardFaces.push(billboardFace);
                this.$forceUpdate();
            },
            destroy(billboardFace) {
                let self = this;
                Slc.delete(laroute.route('api.billboard-face.destroy', {billboard_face: billboardFace.id}), billboardFace.destroyForm)
                    .then(() => {
                        self.removeBillboardFace(billboardFace);
                    });
            },
            removeBillboardFace(billboardFace) {
                this.billboardFaces.splice(this.findIndex(billboardFace), 1);
            },
            findIndex(billboardFace) {
                return this.billboardFaces.findIndex((_billboardFace) => {
                    return _billboardFace.id === billboardFace.id;
                });
            },

            formatMoney(money) {
                money = money.toString();
                var tmp = money.replace(".", "");
                tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
                if (tmp.length > 6)
                    tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

                return tmp;
            }
        }
    }
</script>