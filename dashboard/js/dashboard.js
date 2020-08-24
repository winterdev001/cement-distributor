// admin dashboard

var app = angular.module('dash', []);
app.controller('dashController', function ($scope, $http) {
  $scope.getProducts = () => {
    $http.get("../api/getProducts.php").then((Response) => {
      $scope.products = Response.data;
      // console.log(Response)
    })
  }

  $scope.addProduct = function(product){
    $scope.add_product= false;
  }

  $scope.getProducts();
});