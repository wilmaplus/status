/*
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */


function mainController($scope, $mdThemingProvider, $mdDialog, $http, $location, $translate) {
    $mdThemingProvider.theme("default");
    $scope.loaded = false;
    $scope.error = false;
    $scope.errorreason = "";
    $scope.getDate = function (date) {
        return new Date(date).toLocaleDateString()
    }
    $scope.getTime = function (origDate, date) {
        origDate = origDate.replace(" ", "T");
        date = date.replace(" ", "T");
        var origJSDate = new Date(origDate);
        var jsDate = new Date(date);
        if (!sameDay(origJSDate, jsDate)) {
            return jsDate.toLocaleString();
        } else
            return jsDate.toLocaleTimeString()
    }
    $scope.maintenancejobs = [];
    $scope.servers = [];
    $scope.openHelp = function () {
        $mdDialog.show({
            templateUrl: baseURL + 'templates/guide.html',
            parent: angular.element(document.body),
            clickOutsideToClose: true,
        });
    };
    $scope.refresh = function () {
        $scope.loaded = false;
        $scope.error = false;
        load();
    }

    function load() {
        get_request(baseURL + "api/v1/servers/", $http, $translate, function (data) {
            $scope.error = false;
            $scope.servers = data.servers;
            $scope.maintenancejobs = data.maintenances;
            $scope.updated = data.refresh_date;
            $scope.loaded = true;
        }, function (data) {
            $scope.loaded = false;
            $scope.error = true;
            $scope.error_reason = data;
        })
    }

    load();
}