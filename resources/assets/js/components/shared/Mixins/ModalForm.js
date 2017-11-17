import * as Slc from "../../../vue/http";

export default {
    props: {},

    data() {
        return {
            form: this.buildForm(),
            api: null,
            route: {
                model: null,
                store: null,
                update: null
            },
            isShown: false,
        }
    },

    mounted() {
        const self = this;
        this.reset();
        $(this.$el).on('shown.bs.modal', () => {
            self.$emit('shown');
            self.isShown = true;
        });
        $(this.$el).on('hidden.bs.modal', () => {
            self.$emit('hidden');
            self.isShown = false;
        });

    },

    computed: {
        storeRoute() {
            if (!this.route.store)
                return laroute.route(`api.${this.api}.store`);

            return laroute.route(this.route.store);
        },
        updateRoute() {
            let data = {};
            data[!this.route.model ? this.api.replace("-", "_") : this.route.model] = this.form.id;
            return (!this.route.update) ? laroute.route(`api.${this.api}.update`, data) : laroute.route(this.route.update, data);
        }
    },

    methods: {
        show(obj) {
            console.log("Show form");
            this.form = this.buildForm(obj);
            $(this.$el).modal('show');
        },
        reset() {
            this.form = this.buildForm();
        },
        buildForm() {
        },
        save() {
            this.form.id ? this.update() : this.add();
        },
        add() {
            this.send('post', this.storeRoute);
        },
        update(form) {
            this.form = form ? form : this.form;
            this.send('put', this.updateRoute);
        },
        send(method, route) {
            const event = method === 'post' ? 'created' : 'updated';
            Slc[method](route, this.form)
                .then((response) => {
                    this.saved(response.data, event);
                });
        },
        saved(obj, event) {
            $(this.$el).modal('hide');
            this.$emit('saved', obj);
            this.$emit(event, obj);
        }
    }
};