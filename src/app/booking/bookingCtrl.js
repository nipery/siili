//bookingCtrl.js
(function () {

    angular
      .module('app.booking')
      .controller('bookingCtrl', bookingCtrl);

    bookingCtrl.$inject =['$state', '$http'];

    function bookingCtrl($state, $http) {
        var vm = this;

        vm.wods = [];
        vm.title = 'booking controller';
    }
})();

