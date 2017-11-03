require('./shared/_register');

//USER
Vue.component('user-list', require('./user/user-list.vue'));
Vue.component('user-settings', require('./user/user-settings'));
Vue.component('user-profile', require('./user/user-profile2.vue'));
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
Vue.component('client-select',require('./client/client-select'));
// BILLBOARD
Vue.component('billboard-list', require('./billboard/billboard-list'));
Vue.component('billboard-edit', require('./billboard/billboard-edit'));
Vue.component('billboard-show', require('./billboard-public/billboard-show'));

//GENERATE-PROPOSAL
Vue.component('proposal', require('./generate-proposal/proposal'));

//TEAM
Vue.component('team-settings', require('./team/settings'));