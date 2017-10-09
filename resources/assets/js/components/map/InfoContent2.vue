<template>
    <div class="info-window">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" v-for="faces in billboardFaces">
                <a class="" @click="showMe(faces.id)">{{faces.label}}</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div v-for="faces in billboardFaces" v-if="pages.index == faces.id">
                <column size="6">
                    <img :src="faces.photo" width="100%">
                </column>
                <column size="6">
                    <h3>code: {{faces.code}}</h3>
                    <h3>
                        <strong>U$:</strong>
                        {{faces.hard_cost}}
                    </h3>
                    <h3>
                        {{faces.is_illuminated}}
                    </h3>
                </column>
                <column size="12">
                    <h3>Notes:</h3>
                </column>
                <column size="12">
                    <p>{{faces.notes}}</p>
                </column>
            </div>
        </div>
    </div>
</template>
<style>
    .tab-content {
        padding-top: 15px;
    }
</style>
<script>

    import * as Slc from "../../vue/http";

    export default {

        props: {

            billboardFaces: {
                required: true,
            },

        },

        data(){
            return {
                pages: {
                    index: null,
                    page: {
                        view: false,
                    },
                }
            }
        },

        computed: {},

        mounted(){
            //this.setCurrentPage();
        },

        methods: {

            showMe(position){
                this.pages.index = position;
                return this.pages.view = true;
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