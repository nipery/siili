//bookingCtrl.js
(function () {


    function shopCtrl($state, $http) {
        var vm = this;
        // {{ item.id }}" name="{{ item.name }}" price="{{ item.price }}

        vm.item = { "id": 123, "name": "huppari", "price": 199 };
        vm.wods = [];
        vm.title = 'shop controller';
    }

    shopCtrl.$inject = ['$state', '$http'];

    angular
     .module('app.shop')
     .controller('shopCtrl', shopCtrl);

})();

