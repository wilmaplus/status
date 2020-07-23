/*
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */

function lowercase(string) {
    return (typeof string === 'string') ? string.toLowerCase() : string;
}


function log(message) {
    if (debug)
        console.log(message);
}

function get_request(url, $http, $translate, callback, errCallback = undefined) {
    $http.get(url)
        .then(function (response) {
            if (response.data.status === true) {
                callback(response.data);
            } else {
                errCallback(response.data.cause);
            }
        }, function errorCallback(response) {
            if (response.status !== -1) {
                if (errCallback !== undefined)
                    errCallback(response.data.cause);
            } else {
                if (errCallback !== undefined)
                    errCallback($translate.instant("internet_error"));
            }

        });
}

function post_request(url, data, $http, $translate, $mdDialog, callback, errCallback = undefined) {
    $http.post(url, data)
        .then(function (response) {
            if (response.data.status === true) {
                callback(response.data);
            } else {
                var unknownError = $mdDialog.alert()
                    .title($translate.instant('error_occurred'))
                    .textContent(response.data.cause)
                    .ok($translate.instant('ok'));
                $mdDialog.show(unknownError);
            }
        }, function errorCallback(response) {
            if (errCallback !== undefined)
                errCallback(response);
            var unknownError = $mdDialog.alert()
                .title($translate.instant('error_occurred'))
                .textContent(response.data.cause)
                .ok($translate.instant('ok'));
            $mdDialog.show(unknownError);
        });
}

function sameDay(d1, d2) {
    return d1.getFullYear() === d2.getFullYear() &&
        d1.getMonth() === d2.getMonth() &&
        d1.getDate() === d2.getDate();
}


function configureMain($mdThemingProvider, $routeProvider, $locationProvider, $provide, $translateProvider, $mdIconProvider) {
    $locationProvider.html5Mode(true);
    $locationProvider.hashPrefix('');
    $mdIconProvider.fontSet('md', 'material-icons');


    $translateProvider.translations('fi', fi_lang);

    $translateProvider.translations('en', en_lang);

    $translateProvider.preferredLanguage((navigator.language.includes("fi-FI")) ? "fi" : "en");

    $mdThemingProvider.definePalette('wilmaPlusTheme', {
        '50': 'e9e9e9',
        '100': 'e9e9e9',
        '200': 'e9e9e9',
        '300': 'e9e9e9',
        '400': 'e9e9e9',
        '500': '00ACC1',
        '600': '00ACC1',
        '700': '00ACC1',
        '800': '00ACC1',
        '900': '00ACC1',
        'A100': '00ACC1',
        'A200': '00ACC1',
        'A400': '00ACC1',
        'A700': '00ACC1',
        'contrastDefaultColor': 'light',    // whether, by default, text (contrast)
                                            // on this palette should be dark or light
        'contrastDarkColors': ['50', '100', //hues which contrast should be 'dark' by default
            '200', '300', '400', 'A100'],
        'contrastLightColors': undefined    // could also specify this if default was 'dark'
    });

    $mdThemingProvider.definePalette('wilmaPlusAccent', {
        '50': 'e9e9e9',
        '100': 'e9e9e9',
        '200': 'e9e9e9',
        '300': 'e9e9e9',
        '400': 'e9e9e9',
        '500': '00ACC1',
        '600': '00ACC1',
        '700': '00ACC1',
        '800': '00ACC1',
        '900': '00ACC1',
        'A100': '00ACC1',
        'A200': '00ACC1',
        'A400': '00ACC1',
        'A700': '00ACC1',
        'contrastDefaultColor': 'light',    // whether, by default, text (contrast)
                                            // on this palette should be dark or light
        'contrastDarkColors': ['50', '100', //hues which contrast should be 'dark' by default
            '200', '300', '400', 'A100'],
        'contrastLightColors': undefined    // could also specify this if default was 'dark'
    });

    $mdThemingProvider.alwaysWatchTheme(true);
    if (hasSunsetStarted()) {
        $mdThemingProvider.theme('default').primaryPalette('wilmaPlusTheme').accentPalette('wilmaPlusAccent').dark();
    } else {
        $mdThemingProvider.theme('default').primaryPalette('wilmaPlusTheme').accentPalette('wilmaPlusAccent');
    }
    $mdThemingProvider.alwaysWatchTheme(true);
    $provide.value('$mdThemingProvider', $mdThemingProvider);
    $routeProvider
        .when("/", {
            templateUrl: baseURL + "templates/main.html",
            controller: "main"
        }).otherwise({
        templateUrl: baseURL + "templates/404.html",
        controller: "404err"
    });
}