<template>
    <modal size="md">
        <modal-header>{{ title }}</modal-header>
        <form-submit v-model="form" @submit="save">
            <modal-body>
                <row>
                    <column size="12">
                        <form-group :form="form" field="price">
                            <input-label for="price">Price: </input-label>
                            <input-text v-model="form.price" id="price" name="price" v-money></input-text>
                            <small v-if="face" class="pull-right p-xs">Rate Card: {{face.rate_card | money('$')}}
                            </small>
                        </form-group>
                    </column>
                </row>
            </modal-body>

            <modal-footer>
                <btn-submit :disabled="form.busy">
                    <spinner v-if="form.busy"></spinner>
                </btn-submit>
            </modal-footer>
        </form-submit>
    </modal>
</template>

<style lang="scss" scoped="true">

</style>

<script>
    import ModalForm from '../../shared/Mixins/ModalForm';
    import * as _ from "lodash";
    import store from './store';

    export default {
        mixins: [ModalForm],
        components: {},
        store,
        data() {
            return {
                face: null,
                route: {
                    model: 'face',
                    store: 'api.proposal.create-billboard-face',
                    update: 'api.proposal.update-billboard-face',
                }
            }
        },
        mounted() {

        },
        computed: {
            title() {
                if (this.face && this.face.pivot) {
                    return 'Edit Billboard Face';
                }
                return `Add Billboard Face`;
            },
        },
        methods: {
            save() {
                this.face.pivot ? this.update() : this.add();
            },
            buildForm(face) {
                console.log("Build billboard face form", face);
                this.face = face;
                return new SlcForm({
                    id: face ? face.id : null,
                    proposal_id: this.$store.state.proposal ? this.$store.state.proposal.id : null,
                    price: (face && face.pivot) ? face.pivot.price : null,
                });
            }
        }
    }
</script>