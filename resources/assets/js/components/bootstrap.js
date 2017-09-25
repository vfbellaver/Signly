require('./shared/_register');

Vue.component('user-list', require('./user/user-list.vue'));

Vue.component('main-map', require('./map/main-map.vue'));

Vue.component('info-content', require('./shared/InfoContent.vue'));

Vue.component('billboard-list', require('./billboard/billboard-list.vue'));

Vue.component('billboard-face-list', require('./billboard-face/billboard-face-list.vue'));

Vue.component('csv-upload-billboard-list',require('./billboard/billboard-csv-upload.vue'));

Vue.component('client-list', require('./client/client-list.vue'));
