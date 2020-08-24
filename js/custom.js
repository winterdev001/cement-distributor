// user ui
var app = angular.module('main-app', []);
app.controller('ProductController', function ($scope, $http) {
  $scope.data = [];

  // getResultsPage();

  // function getResultsPage() {
  //   $http({
  //     url: '../api/getData.php',
  //     method: 'GET'
  //   }).then(function (res) {
  //     $scope.products = res.data;
  //     console.log(res)
  //   });
  // }
  $scope.getfeed = () => {
    $http.get("api/getData.php").then((Response) => {
      $scope.products = Response.data;
      console.log(Response)
    })
  }

  $scope.getfeed();

  $scope.showProduct = (product) => {
    let show_products = {
      method: 'POST',
      url: 'api/showProduct.php',
      data: {
        id: product.id
      }
    };
    $http(show_products).then((res) => {
      data = res.data;
      // console.log(data[0].fineness);
      $scope.show_fineness = data[0].fineness;
      $scope.show_strength = data[0].compressive_strength;
      $scope.show_color = data[0].color;
      $scope.show_weight = data[0].weight;
      $scope.show_application = data[0].application;
      $scope.show_packaging_type = data[0].packaging_type;
    });

    $scope.show_product_name = product.product_name;
    $scope.show_quantity = product.quantity;
    $scope.show_amount = product.amount;
    $scope.show_manufacturer = product.manufacturer;
    $scope.show_created_at = product.created_at;
    $scope.show_product_id = product.id;
    // alert(product.product_name);
    console.log('okay');
  }
  // $scope.saveAdd = function () {
  //   $http({
  //     url: '/api/add.php',
  //     method: 'POST'
  //   }).then(function (data) {
  //     $scope.data.push(data.data);
  //     $(".modal").modal("hide");
  //   });
  // }

  // $scope.edit = function (id) {
  //   $http({
  //     url: '/api/edit.php?id=' + id,
  //     method: 'GET'
  //   }).then(function (data) {
  //     $scope.form = data.data;
  //   });
  // }

  // $scope.saveEdit = function () {
  //   $http({
  //     url: '/api/update.php?id=' + $scope.form.id,
  //     method: 'POST'
  //   }).then(function (data) {
  //     $(".modal").modal("hide");
  //     $scope.data = apiModifyTable($scope.data, data.data.id, data.data);
  //   });
  // }

  // $scope.remove = function (post, index) {
  //   var result = confirm("Are you sure to delete this post?");
  //   if (result) {
  //     $http({
  //       url: '/api/delete.php?id=' + post.id,
  //       method: 'DELETE'
  //     }).then(function (data) {
  //       $scope.data.splice(index, 1);
  //     });
  //   }
  // }
});

