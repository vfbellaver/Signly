require('./shared/_register');

// ------------------------------------------------------------------------
// User
Vue.component('user-list', require('./user/user-list.vue'));
Vue.component('user-settings', require('./user/user-settings'));

// ------------------------------------------------------------------------
// Billboard-face
Vue.component('billboard-list', require('./billboard/billboard-list'));
Vue.component('billboard-edit', require('./billboard/billboard-edit'));
Vue.component('billboard-form-csv',require('./billboard/billboard-form-csv.vue'));

// ------------------------------------------------------------------------
// Billboard-face
Vue.component('billboard-face-list-card', require('./billboard-face/billboard-card-face-list.vue'));
Vue.component('billboard-face-card', require('./billboard-face/billboard-face-card.vue'));
Vue.component('billboard-face-list', require('./billboard-face/billboard-face-list'));

// ------------------------------------------------------------------------
// Client
Vue.component('client-list', require('./client/client-list.vue'));

// ------------------------------------------------------------------------
// Maps
Vue.component('google-map', require('./map/google-map'));
Vue.component('main-map', require('./map/main-map.vue'));
Vue.component('info-content', require('./map/InfoContent.vue'));