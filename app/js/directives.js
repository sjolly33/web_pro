'use strict';

/* Directives */


angular.module('pro_site_app.directives', []).
    directive('appVersion', ['version', function (version) {
        return function (scope, elm) {
            elm.text(version);
        };
    }])
    .directive('rank',function () {
        return {
            restrict: 'E',
            replace: true,
            scope: {
                score: '=',
                ceil: '='
            },
            templateUrl: 'partials/directives/rating.html'
        };
    }).directive('cover', function () {
        return {
            restrict: 'E',
            replace: true,
            scope: {
                albumId: '='
            },
            templateUrl: 'partials/directives/cover.html'
        };
    });

