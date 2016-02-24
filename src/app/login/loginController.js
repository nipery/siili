(function () {
    
    angular
      .module('app.login')
      .controller('loginController', loginController);

    loginController.$inject = ['$state', '$http'];

    function loginController($state, $http) {
        var vm = this;
        
        vm.title = 'login controller';
        
        vm.userInfo ={
            username: undefined,
            password: undefined,
            token:undefined
        }
    }

})();