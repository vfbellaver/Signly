<template>
    <div>
        <div  v-for="face in billboardFaces">
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

                                    <h2 class="font-bold m-b-xs">
                                        Desktop publishing software
                                    </h2>
                                    <small>Many desktop publishing packages and web page editors now.</small>
                                    <hr>
                                    <div>
                                        <button class="btn btn-primary pull-right">Add to cart</button>
                                        <h1 class="product-main-price">$406,602 <small class="text-muted">Exclude Tax</small> </h1>
                                    </div>
                                    <hr>
                                    <h4>Product description</h4>

                                    <div class="small text-muted">
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at its layout. The point of using Lorem Ipsum is
                                        that it has a more-or-less normal distribution of letters, as opposed to using
                                        'Content here, content here', making it look like readable English.
                                        <br>
                                        <br>
                                        There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form, by injected humour, or randomised words
                                        which don't look even slightly believable.
                                    </div>
                                    <dl class="dl-horizontal m-t-md small">
                                        <dt>Description lists</dt>
                                        <dd>A description list is perfect for defining terms.</dd>
                                        <dt>Euismod</dt>
                                        <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                                        <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                                        <dt>Malesuada porta</dt>
                                        <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                                        <dt>Felis euismod semper eget</dt>
                                        <dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>
                                    </dl>
                                    <div class="text-right">
                                        <div class="btn-group">
                                            <button class="btn btn-white btn-sm"><i class="fa fa-star"></i> Add to wishlist </button>
                                            <button class="btn btn-white btn-sm"><i class="fa fa-envelope"></i> Contact with author </button>
                                        </div>
                                    </div>

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

        }
    }
</script>