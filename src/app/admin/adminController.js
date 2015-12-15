//adminController.js
(function () {

    angular
      .module('app.admin')
      .controller('adminCtrl', adminCtrl);

    adminCtrl.$inject = ['$state', '$http'];

    function adminCtrl($state, $http) {
        var vm = this;

        vm.wods = [];
        vm.title = 'Admin controller';    
    }
})();