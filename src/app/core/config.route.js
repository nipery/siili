//config.route.js

(function () {

    'use strict';

    angular
        .module('app.core')
        .config([
            '$urlRouterProvider', '$stateProvider', function($urlRouterProvider, $stateProvider) {
                $urlRouterProvider.otherwise('/');

                $stateProvider
                    .state('home', {
                        url: '/',
                        templateUrl: 'app/pages/home.html'
                    }).state('wods', {
                        url: '/wod',
                        templateUrl: 'app/wods/wods.html',
                        controller: 'wodCtrl',
                        controllerAs: 'vm'
                    }).state('admin', {
                        url: '/admin',
                        templateUrl: 'app/admin/admin.html',
                        controller: 'adminCtrl',
                        controllerAs: 'vm'
                    }).state('booking', {
                        url: '/booking',
                        templateUrl: 'app/booking/booking.html',
                        controller: 'bookingCtrl',
                        controllerAs: 'vm'
                    }).state('basics', {
                        url: '/basics',
                        templateUrl: 'app/basics/basics.html'

                    }).state('shop', {
                        url: '/shop',
                        templateUrl: 'app/shop/shop.html',
                        controller: 'shopCtrl',
                        controllerAs: "vm"
            });

            }
        ]);

})();