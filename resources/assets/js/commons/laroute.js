(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://signly.dev',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/open","name":"debugbar.openhandler","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@handle"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css","action":"Barryvdh\Debugbar\Controllers\AssetController@css"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js","action":"Barryvdh\Debugbar\Controllers\AssetController@js"},{"host":null,"methods":["GET","HEAD"],"uri":"_dusk\/login\/{userId}\/{guard?}","name":null,"action":"Laravel\Dusk\Http\Controllers\UserController@login"},{"host":null,"methods":["GET","HEAD"],"uri":"_dusk\/logout\/{guard?}","name":null,"action":"Laravel\Dusk\Http\Controllers\UserController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"_dusk\/user\/{guard?}","name":null,"action":"Laravel\Dusk\Http\Controllers\UserController@user"},{"host":null,"methods":["POST"],"uri":"api\/image\/upload","name":"api.image.upload","action":"App\Http\Controllers\Api\FileUploadController@imageUpload"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/role","name":"api.role.index","action":"App\Http\Controllers\Api\RolesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":"api.user.index","action":"App\Http\Controllers\Api\UsersController@index"},{"host":null,"methods":["POST"],"uri":"api\/user","name":"api.user.store","action":"App\Http\Controllers\Api\UsersController@store"},{"host":null,"methods":["PUT","PATCH"],"uri":"api\/user\/{user}","name":"api.user.update","action":"App\Http\Controllers\Api\UsersController@update"},{"host":null,"methods":["DELETE"],"uri":"api\/user\/{user}","name":"api.user.destroy","action":"App\Http\Controllers\Api\UsersController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/current-user","name":"api.current.user","action":"App\Http\Controllers\Api\CurrentUserController"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/billboard-face","name":"api.billboard-face.index","action":"App\Http\Controllers\Api\BillboardFacesController@index"},{"host":null,"methods":["POST"],"uri":"api\/billboard-face","name":"api.billboard-face.store","action":"App\Http\Controllers\Api\BillboardFacesController@store"},{"host":null,"methods":["PUT","PATCH"],"uri":"api\/billboard-face\/{billboard_face}","name":"api.billboard-face.update","action":"App\Http\Controllers\Api\BillboardFacesController@update"},{"host":null,"methods":["DELETE"],"uri":"api\/billboard-face\/{billboard_face}","name":"api.billboard-face.destroy","action":"App\Http\Controllers\Api\BillboardFacesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/client","name":"api.client.index","action":"App\Http\Controllers\Api\ClientsController@index"},{"host":null,"methods":["POST"],"uri":"api\/client","name":"api.client.store","action":"App\Http\Controllers\Api\ClientsController@store"},{"host":null,"methods":["PUT","PATCH"],"uri":"api\/client\/{client}","name":"api.client.update","action":"App\Http\Controllers\Api\ClientsController@update"},{"host":null,"methods":["DELETE"],"uri":"api\/client\/{client}","name":"api.client.destroy","action":"App\Http\Controllers\Api\ClientsController@destroy"},{"host":null,"methods":["POST"],"uri":"api\/csv\/upload","name":"api.csv.upload","action":"App\Http\Controllers\Api\BillboardsCsvController@CsvConvertArray"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/csv","name":"api.csv.index","action":"App\Http\Controllers\Api\BillboardsCsvController@index"},{"host":null,"methods":["POST"],"uri":"api\/csv","name":"api.csv.store","action":"App\Http\Controllers\Api\BillboardsCsvController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/billboard","name":"api.billboard.index","action":"App\Http\Controllers\Api\BillboardsController@index"},{"host":null,"methods":["POST"],"uri":"api\/billboard","name":"api.billboard.store","action":"App\Http\Controllers\Api\BillboardsController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/billboard\/{billboard}","name":"api.billboard.show","action":"App\Http\Controllers\Api\BillboardsController@show"},{"host":null,"methods":["PUT","PATCH"],"uri":"api\/billboard\/{billboard}","name":"api.billboard.update","action":"App\Http\Controllers\Api\BillboardsController@update"},{"host":null,"methods":["DELETE"],"uri":"api\/billboard\/{billboard}","name":"api.billboard.destroy","action":"App\Http\Controllers\Api\BillboardsController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"roles","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"password.request","action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"password.email","action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":"password.reset","action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"invitation\/{token}","name":"invitation","action":"App\Http\Controllers\Web\UserInvitationsController"},{"host":null,"methods":["POST"],"uri":"register","name":"register","action":"App\Http\Controllers\Web\UserRegistrationsController"},{"host":null,"methods":["GET","HEAD"],"uri":"users","name":"users.index","action":"App\Http\Controllers\Web\UsersController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home","action":"App\Http\Controllers\Web\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"billboard-faces","name":"billboard-faces.index","action":"App\Http\Controllers\Web\BillboardFacesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"clients","name":"clients.index","action":"App\Http\Controllers\Web\ClientsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"csv-upload","name":"csv-upload.index","action":"App\Http\Controllers\Web\BillboardsCsvController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"billboards","name":"billboards.index","action":"App\Http\Controllers\Web\BillboardsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"billboards\/{billboard}\/edit","name":"billboards.edit","action":"App\Http\Controllers\Web\BillboardsController@edit"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

