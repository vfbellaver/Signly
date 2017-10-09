require('./shared/_register');

//USER
Vue.component('user-list', require('./user/user-list.vue'));
Vue.component('user-settings', require('./user/user-settings'));

Vue.component('main-map', require('./map/main-map.vue'));
Vue.component('info-content', require('./map/InfoContent.vue'));

//TEAM
Vue.component('team-list', require('./team/team-list.vue'));

//CLIENT
Vue.component('client-list', require('./client/client-list'));
Vue.component('client-create',require('./client/client-create'));
Vue.component('client-edit',require('./client/client-edit'));

// BILLBOARD
Vue.component('billboard-list', require('./billboard/billboard-list'));
Vue.component('billboard-create', require('./billboard/billboard-create'));
Vue.component('billboard-edit', require('./billboard/billboard-edit'));
Vue.component('billboard-show', require('./billboard-public/billboard-show'));

// ------------------------------------------------------------------------
// Maps
Vue.component('google-map', require('./map/google-map'));

Vue.component('parent', require('./demo/parent'));
