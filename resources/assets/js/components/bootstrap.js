require('./shared/_register');

//USER
Vue.component('user-list', require('./user/user-list.vue'));
Vue.component('user-settings', require('./user/settings'));

//MAP
Vue.component('main-map', require('./map/main-map'));

// Slider
Vue.component('slider', require('./slider/menu'));

//Payment
Vue.component('register', require('./payment/register'));
Vue.component('plan', require('./payment/plan'));
Vue.component('user-card', require('./user/user-card'));
Vue.component('profile', require('./payment/profile'));

//CLIENT
Vue.component('client-list', require('./client/client-list'));
Vue.component('client-list-two', require('./client/client-list-two'));
Vue.component('client-form', require('./client/client-form'));
Vue.component('client-select', require('./client/client-select'));
// BILLBOARD
Vue.component('billboard-list', require('./billboard/billboard-list'));
Vue.component('billboard-edit', require('./billboard/billboard-edit'));
Vue.component('billboard-show', require('./billboard-public/billboard-show'));
//TEAM
Vue.component('team-settings', require('./team/settings'));
//PROPOSAL
Vue.component('proposal-list', require('./proposal/proposal-list.vue'));
Vue.component('proposal-show', require('./proposal/proposal-show.vue'));
