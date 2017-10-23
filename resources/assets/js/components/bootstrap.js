require('./shared/_register');

//USER
Vue.component('user-list', require('./user/user-list.vue'));
Vue.component('user-settings', require('./user/user-settings'));

//MAP
Vue.component('main-map', require('./map/main-map'));

//Payment
Vue.component('plan', require('./payment/plan'));
Vue.component('content-plan', require('./payment/content-plan'));
Vue.component('plan-modal', require('./payment/plan-modal'));
Vue.component('profile', require('./payment/profile'));

//TEAM
Vue.component('team-list', require('./team/team-list.vue'));

//CLIENT
Vue.component('client-list', require('./client/client-list'));
Vue.component('client-list-two', require('./client/client-list-two'));
Vue.component('client-form',require('./client/client-form'));

// BILLBOARD
Vue.component('billboard-list', require('./billboard/billboard-list'));
Vue.component('billboard-edit', require('./billboard/billboard-edit'));
Vue.component('billboard-show', require('./billboard-public/billboard-show'));

//DEMO
Vue.component('parent', require('./demo/parent'));
