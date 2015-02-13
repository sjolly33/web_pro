'use strict';

angular.module('pro_site_app.routes', ['ngRoute'])
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/search', {templateUrl: 'partials/search.html', controller: 'SearchCtrl'});
        $routeProvider.when('/info', {templateUrl: 'partials/info.html', controller: 'InfoCtrl'});
        $routeProvider.otherwise({redirectTo: '/search'});
    }]);

