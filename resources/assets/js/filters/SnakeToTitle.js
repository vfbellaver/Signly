Vue.filter('snakeToTitle', function (str) {
    if( str ) {
        return str.split('_').map(function (item) {
            return item.charAt(0).toUpperCase() + item.substring(1);
        }).join(' ');
    }

    return '';
});