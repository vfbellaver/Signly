<template>
    <div class="card-container">
        <column size="4">
            <img width="100%" :src="billboardFace.photo">
        </column>
        <column size="8">
            <div class="card-body">
                <box>
                    <h3>Code: {{billboardFace.code}} &nbsp Label: {{billboardFace.label}} </h3>
                    <box-content>
                        <column size="12">
                            <h4>Width: {{billboardFace.width}} &nbsp
                                &nbsp Heigth: {{billboardFace.height}}
                            </h4>
                        </column>
                        <column size="12">
                            <h4>Monthly Impressions: {{billboardFace.monthly_impressions}} &nbsp</h4>
                            <h4 v-model="money">Hard Cost U$ : {{getMoney}} &nbsp </h4>
                        </column>
                        <column size="12">
                            <slot></slot>
                        </column>
                    </box-content>
                </box>
            </div>
        </column>
        <div style="clear: both"></div>
    </div>
</template>

<script>
    export default {
        props: {
            billboardFace: {required: true}
        },

        data() {
            return {
                money: this.billboardFace.hard_cost,
            }
        },

        computed: {

            getMoney(){

                let valor = this.money.toString();
                valor = valor.replace('.', '');

                return this.formatMoney(valor);
            }
        },

        methods: {

            formatMoney(valor){

                var tmp = valor + '';

                tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
                if (tmp.length > 6)
                    tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

                return tmp;
            }
        }
    }
</script>