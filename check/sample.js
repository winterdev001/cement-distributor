var app = angular.module('myApp', []);

// here we define our unique filter
app.filter("unique", function () {
    // we will return a function which will take in a collection
    // and a keyname
    return function (collection, keyname) {
        // we define our output and keys array;
        var output = [],
            keys = [];

        // we utilize angular's foreach function
        // this takes in our original collection and an iterator function
        angular.forEach(collection, function (item) {
            // we check to see whether our object exists
            var key = item[keyname];
            // if it's not already part of our keys array
            if (keys.indexOf(key) === -1) {
                // add it to our keys array
                keys.push(key);
                // push this item to our final output array
                output.push(item);
            }
        });
        // return our array which should be devoid of
        // any duplicates
        return output;
    };
});

app.controller('myCtrl', function ($scope, $http) {
    // $scope.data = {
    //     "Suv": {
    //         "Gas": {
    //             "Automatic": {
    //                 "Black": [
    //                     "BMW",
    //                     "Honda",
    //                     "Hyundai"
    //                 ],
    //                 "Green": [
    //                     "Brabus"
    //                 ]
    //             }
    //         }
    //     },
    //     "Sports": {
    //         "Oil": {
    //             "Manual": {
    //                 "White": [
    //                     "Rambo",
    //                     "Mclaren",
    //                     "Ferrari"
    //                 ],
    //                 "Blue": [
    //                     "Maserati"
    //                 ]
    //             }
    //         }
    //     },
    //     "Truck": {
    //         "Electricity": {
    //             "Electric": {
    //                 "Red": [
    //                     "Tesla",
    //                     "Mercedes"
    //                 ],
    //                 "Orange": [
    //                     "Audi"
    //                 ]
    //             }
    //         }
    //     }
    // }
    // $scope.getData = ()=>{
    //     $http.get('api/data.json').then((response) =>{
    //         $scope.data = response.data;
    //         // console.log(response.data)
    //     });
    // }
    // $scope.getData();

    // $scope.restructureData = () => {
    //     $scope.restructured = Object.entries($scope.data)
    //     $scope.types
    //     $scope.fuel = []
    //     $scope.transmission = []
    //     $scope.color = []
    //     $scope.model = []
    //     $scope.types = Object.keys($scope.data)
    //     for (a = 0; a < $scope.restructured.length; a++) {
    //         $scope.fuel.push(Object.keys($scope.restructured[a][1])[0],Object.keys($scope.restructured[a][1])[1],Object.keys($scope.restructured[a][1])[2],Object.keys($scope.restructured[a][1])[3],Object.keys($scope.restructured[a][1])[4],Object.keys($scope.restructured[a][1])[5],Object.keys($scope.restructured[a][1])[6])
    //         $scope.transmission.push(Object.keys(Object.entries($scope.restructured[a][1])[0][1])[0])
    //         // $scope.color.push(Object.keys(Object.entries(Object.entries($scope.restructured[a][1])[0][1])[0][1]))
    //         // for (x = 0; x < Object.entries(Object.entries(Object.entries($scope.restructured[0][1])[0][1])[0][1]).length; x++) {
    //         //     $scope.model.push(Object.entries(Object.entries(Object.entries($scope.restructured[a][1])[0][1])[0][1])[x][1])
    //         // }
    //     };
    //     console.log($scope.types)
    //     console.log($scope.fuel)
    //     console.log($scope.transmission)
    //     console.log($scope.color)
    //     console.log($scope.model)
    //     console.log($scope.restructured.length)
    // }

    // $scope.restructureData()   


    $scope.getAddress = () => {
        $http.get("api/address.json").then((response) => {
            $scope.addresses = response.data;
            console.log(response.data)
        });
    }

    $scope.getAddress();

});