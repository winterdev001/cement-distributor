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

// admin dashboard

var app = angular.module('admin', []);

app.controller('myCtrl', function ($scope, $http,$window) {
 
  $scope.getProducts = () => {
    $http.get("api/getProducts.php").then((Response) => {
      $scope.products = Response.data;
      console.log(Response)
    })
  }

  $scope.getProducts();

  $scope.get_admin_info = () => {
    $http.get("api/admininfo.php").then((Response) => {
      data = Response.data;
      
      $scope.admin_name = data[0].username;
      // $scope.loggedin = 'gucci';
      // console.log(Response.data);
    })
  }
  $scope.get_admin_info();
});