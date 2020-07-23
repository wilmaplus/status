/*
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */

angular.lowercase = lowercase;
var app = angular.module('wilmaplus-status', ['ngMaterial', 'ngMessages', 'material.svgAssetsCache', 'ngRoute', 'pascalprecht.translate'])
    .config(configureMain);


app.controller("WebCtl", function ($scope, $translate) {

})

app.controller('404err', function ($scope, $mdThemingProvider, $location) {
    $mdThemingProvider.setDefaultTheme('default');
    $scope.navigateToPage = function (path) {
        $location.path(path);
    };
});

app.controller('main', mainController)