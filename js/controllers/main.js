/*
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */


function mainController($scope, $mdThemingProvider, $mdDialog, $http, $location, $translate) {
    $mdThemingProvider.theme("default");
    var servers = [
        {
            'available': true,
            'name': 'Sivusto',
            'desc': "Viralliset verkkosivustot https://wilmaplus.fi"

        },
        {
            'available': true,
            'name': 'Rajapinta',
            'desc': "Moottori joka pyörittää Wilma Plussaa"

        },
        {
            'available': false,
            'name': 'Ilmoitusjärjestelmä',
            'desc': "Kokeiden, Tuntimerkintöjen ja Tiedotteiden ilmoitukset"

        }
    ];
    var maintenance = [
        {
            'done': false,
            'name': 'Ilmoitusjärjestelmä',
            'desc': "Ilmoitusjärjestelmää siirretään toiselle palvelimelle",
            'date': "2020-08-15",
            'start': "2020-08-15 11:04",
            'end': "2020-08-15 15:04"
        },
        {
            'done': true,
            'name': 'Ilmoitusjärjestelmä',
            'desc': "Ilmoitusjärjestelmää siirretään toiselle palvelimelle",
            'date': "2020-08-15",
            'start': "2020-08-15 11:04",
            'end': "2020-08-15 15:04"
        }
    ];
    $scope.loaded = false;
    $scope.error = false;
    $scope.loading = true;
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
    $scope.maintenancejobs = maintenance;
    $scope.servers = servers;
    $scope.openHelp = function () {
        $mdDialog.show({
            templateUrl: baseURL + 'templates/guide.html',
            parent: angular.element(document.body),
            clickOutsideToClose: true,
        });
    }
}