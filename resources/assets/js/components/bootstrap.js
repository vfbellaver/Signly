require('./shared/_register');

Vue.component('user-list', require('./user/user-list.vue'));

Vue.component('main-map', require('./map/main-map.vue'));

Vue.component('info-content', require('./shared/InfoContent'));

Vue.component('billboard-list', require('./billboard/billboard-list'));
Vue.component('billboard-edit', require('./billboard/billboard-edit'));
Vue.component('billboard-dashboard', require('./billboard/billboard-dashboard'));

Vue.component('billboard-face-list', require('./billboard-face/billboard-face-list'));
// ------------------------------------------------------------------------
// Billboard-face-cards-list
Vue.component('billboard-face-list-card', require('./billboard-face/FacesCardsList.vue'));
Vue.component('billboard-face-card', require('./billboard-face/FacesCards.vue'));

Vue.component('billboard-form-csv',require('./billboard/billboard-form-csv.vue'));

Vue.component('client-list', require('./client/client-list.vue'));
