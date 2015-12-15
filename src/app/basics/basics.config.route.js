//config.route.js

(function () {

    'use strict';

    angular
        .module('app.basics')
        .config(routerConfig);
        
    /** ngInject*/
    function routerConfig($stateProvider, $urlRouterProvider) {
                
        $urlRouterProvider.otherwise('/');

                $stateProvider
                  .state('basics.prices', {
                    url: '/prices',
                    templateUrl: 'app/basics/pricelist.html'

                }).state('basics.schedule', {
                        url: '/schedule',
                        templateUrl: 'app/basics/schedule.html'

                }).state('basics.rules', {
                    url: '/rules',
                    templateUrl: 'app/basics/rules.html'

                }).state('basics.workouts', {
                    url: '/workouts',
                    templateUrl: 'app/basics/workouts.html'

                }).state('basics.dict', {
                    url: '/dict',
                    templateUrl: 'app/basics/dictionary.html'

                });

       }
       

})();

/*(function() {
  'use strict';

  angular
    .module('cfsiili')
    .config(routerConfig);
*/
  /** @ngInject */
/*  
function routerConfig($stateProvider, $urlRouterProvider) {
    $stateProvider
      .state('home', {
        url: '/',
        templateUrl: 'app/main/main.html',
        controller: 'MainController',
        controllerAs: 'main'
      });

    $urlRouterProvider.otherwise('/');
  }

})(); 

*/