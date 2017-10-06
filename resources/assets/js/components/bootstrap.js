require('./shared/_register');

Vue.component('user-list', require('./user/user-list.vue'));

Vue.component('main-map', require('./map/main-map.vue'));

Vue.component('info-content', require('./map/InfoContent.vue'));

Vue.component('billboard-list', require('./billboard/billboard-list'));
Vue.component('billboard-edit', require('./billboard/billboard-edit'));
Vue.component('billboard-create', require('./billboard/billboard-create'));

Vue.component('billboard-face-list', require('./billboard-face/billboard-face-list'));
Vue.component('billboard-face-card', require('./billboard-face/billboard-face-card'));
Vue.component('billboard-form-csv',require('./billboard/billboard-form-csv'));

Vue.component('client-list', require('./client/client-list'));
Vue.component('client-create', require('./client/client-create'));
Vue.component('client-edit', require('./client/client-edit'));

// ------------------------------------------------------------------------
// Maps
Vue.component('google-map', require('./map/google-map'));