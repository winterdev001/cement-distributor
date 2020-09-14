var app = angular.module('myApp', []);

app.controller('myCtrl', function ($scope, $http, $window) {
  // signup
  $scope.createAccount = () => {
    if ($scope.user_password == null || $scope.confirm_user_password == null || $scope.user_Fname == null || $scope.user_Sname == null || $scope.user_name == null || $scope.user_phone == null || $scope.user_email == null) {

    }
    else if ($scope.user_password != $scope.confirm_user_password) {
      swal({
        text: "the passwords must be the same"
      });
    }
    else {
      let config = {
        method: 'POST',
        url: 'api/signup.php',
        data: {
          'Fname': $scope.user_Fname,
          // 'type': user_type,
          'Sname': $scope.user_Sname,
          'Uname': $scope.user_name,
          'phone': $scope.user_phone,
          'email': $scope.user_email,
          'password': $scope.user_password
        }
      };
      let request = $http(config);
      request.then((response) => {
        if (response.data != 'admin') {
          let uname = response.data;
          if (localStorage.getItem('username') == null) {
            var addUser = localStorage.setItem('username', uname);
            $window.location.href = "userdash.html";
          } else {
            localStorage.removeItem('username');
            var addUser = localStorage.setItem('username', uname)
            $window.location.href = "userdash.html";
            // var getId = localStorage.getItem('id');
            // console.log(getId);
          }
          // $window.location.href = "userdash.html";
        }
        else if (response.data == 'empty') {
          swal({
            text: response.data
          })
        }
        else {
          swal({
            text: response.data
          })
        }
      })
    }
  }

  // login
  $scope.login = () => {
    if ($scope.user_email == null || $scope.user_password == null) {

    }
    else {
      let config = {
        method: 'POST',
        url: 'api/login.php',
        data: {
          'email': $scope.user_email,
          'password': $scope.user_password
        }
      };
      let request = $http(config);
      request.catch(() => {
        swal("Connection Error")
      });
      request.then((response) => {
        if (response.data === "admin") {
          // console.log(response.data);
          let uname = response.data;
          if (localStorage.getItem('username') == null) {
            var addUser = localStorage.setItem('username', uname);
            $window.location.href = "./dashboard/dash.html";
          } else {
            localStorage.removeItem('username');
            var addUser = localStorage.setItem('username', uname)
            $window.location.href = "./dashboard/dash.html";
            // var getId = localStorage.getItem('id');
            // console.log(getId);
          }
        } else if (response.data !== "Email or password is Incorrect") {
          // console.log(response.data);
          let uname = response.data;
          if (localStorage.getItem('username') == null) {
            var addUser = localStorage.setItem('username', uname);
            $window.location.href = "userdash.html";
          } else {
            localStorage.removeItem('username');
            var addUser = localStorage.setItem('username', uname)
            $window.location.href = "userdash.html";
            // var getId = localStorage.getItem('id');
            // console.log(getId);
          }
        } else {
          swal({
            text: response.data,
            confirmButtonColor: '#343a40',
          });
        }
      });
    }
  }
});

var app = angular.module('userDash', []);

app.controller('myCtrl', function ($scope, $http, $window) {
  $scope.get_user_info = () => {
    $http.get("api/customerinfo.php").then((Response) => {
      data = Response.data;
      $scope.customer_name = data[0].username;
      // console.log(Response.data);
    })
  }
  $scope.get_user_info();

});