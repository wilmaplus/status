<?php
/**
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */

/**
 * Controls
 */

define("DEPENDENCIES_LOCAL", true);
define("MINIFY_DEPENDENCIES", false);
define("MINIFY_DEPENDENCIES_HTML", false);


/**
 * This is the Dependencies list, made to switch between offline and online versions if needed
 * And also switch to the minified version
 * Note: The order will be same as it is in this array!
 */

define("FOOTER_DEPENDENCIES", array(
    array(
        "type" => "js",
        "minifyAvailable" => true,
        "local" => "angular/angular.js",
        "remote" => "https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.js"
    ),
    array(
        "type" => "js",
        "minifyAvailable" => false,
        "local" => "angular/angular-animate.min.js",
        "remote" => "https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular-animate.min.js"
    ),
    array(
        "type" => "js",
        "minifyAvailable" => false,
        "local" => "angular/angular-route.min.js",
        "remote" => "https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular-route.min.js"
    ),
    array(
        "type" => "js",
        "minifyAvailable" => false,
        "local" => "angular/angular-aria.min.js",
        "remote" => "https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular-aria.min.js"
    ),
    array(
        "type" => "js",
        "minifyAvailable" => false,
        "local" => "angular/angular-messages.min.js",
        "remote" => "https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular-messages.min.js"
    ),
    array(
        "type" => "js",
        "minifyAvailable" => true,
        "local" => "angular/angular-translate.js",
        "remote" => "https://cdn.rawgit.com/angular-translate/bower-angular-translate/2.5.0/angular-translate.js"
    ),
    array(
        "type" => "js",
        "minifyAvailable" => true,
        "local" => "angular/moment.js",
        "remote" => "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"
    ),
    array(
        "type" => "js",
        "minifyAvailable" => false,
        "local" => "angular/svg-assets-cache.js",
        "remote" => "https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-114/svg-assets-cache.js"
    ),
    array(
        "type" => "js",
        "minifyAvailable" => true,
        "local" => "material/angular-material.js",
        "remote" => "https://ajax.googleapis.com/ajax/libs/angular_material/1.1.21/angular-material.js"
    ),
    array(
        "type" => "js",
        "minifyAvailable" => false,
        "local" => "jquery-3.4.1.min.js",
        "remote" => "https://code.jquery.com/jquery-3.4.1.min.js"
    ),
    array(
        "type" => "js",
        "minifyAvailable" => false,
        "local" => "i18n/fi.js",
    ),
    array(
        "type" => "js",
        "minifyAvailable" => false,
        "local" => "i18n/en.js",
    ),
    array(
        "type" => "js",
        "minifyAvailable" => false,
        "local" => "utils.js",
    ),
    array(
        "type" => "js",
        "minifyAvailable" => false,
        "local" => "main.js",
    )
));

define("HEAD_DEPENDENCIES",
    array(
        array(
            "type" => "css",
            "minifyAvailable" => false,
            "local" => "ubnt_font.css",
            "remote" => "https://fonts.googleapis.com/css?family=Ubuntu:regular"
        ),
        array(
            "type" => "css",
            "minifyAvailable" => false,
            "local" => "angular-material.min.css",
            "remote" => "https://ajax.googleapis.com/ajax/libs/angular_material/1.1.21/angular-material.min.css"
        ),
        array(
            "type" => "css",
            "minifyAvailable" => false,
            "remote" => "https://fonts.googleapis.com/icon?family=Material+Icons"
        ),
        array(
            "type" => "js",
            "minifyAvailable" => true,
            "local" => "dexie.js",
            "remote" => "https://unpkg.com/dexie@2.0.4/dist/dexie.js"
        ),
    ));


function setDependencies(array $dependencies)
{
    foreach ($dependencies as $dependency) {
        $type = $dependency['type'];
        if ($type === "js") {
            $minifyAvail = $dependency['minifyAvailable'];
            $local = (array_key_exists("local", $dependency) ? BASEURL . 'js/' . $dependency['local'] : null);
            $remote = (array_key_exists("remote", $dependency) ? $dependency['remote'] : null);
            if ($local == null && $remote !== null)
                echoJS(makeJSLink($remote, $minifyAvail));
            else if ($remote == null && $local !== null)
                echoJS(makeJSLink($local, $minifyAvail));
            else {
                if (DEPENDENCIES_LOCAL)
                    echoJS(makeJSLink($local, $minifyAvail));
                else
                    echoJS(makeJSLink($remote, $minifyAvail));
            }
        } else if ($type === "css") {
            $minifyAvail = $dependency['minifyAvailable'];
            $local = (array_key_exists("local", $dependency) ? BASEURL . 'css/' . $dependency['local'] : null);
            $remote = (array_key_exists("remote", $dependency) ? $dependency['remote'] : null);
            if ($local == null && $remote !== null)
                echoCSS(makeCSSLink($remote, $minifyAvail));
            else if ($remote == null && $local !== null)
                echoCSS(makeCSSLink($local, $minifyAvail));
            else {
                if (DEPENDENCIES_LOCAL)
                    echoCSS(makeCSSLink($local, $minifyAvail));
                else
                    echoCSS(makeCSSLink($remote, $minifyAvail));
            }
        }
    }
}

function makeJSLink($jsLink, $minifyAvailable)
{
    if ($minifyAvailable && MINIFY_DEPENDENCIES) {
        $parts = explode(".js", $jsLink);
        if (!empty($parts)) {
            return $parts[0] . ".min.js";
        } else
            return $jsLink;
    } else
        return $jsLink;
}

function makeCSSLink($jsLink, $minifyAvailable)
{
    if ($minifyAvailable & MINIFY_DEPENDENCIES) {
        $parts = explode(".css", $jsLink);
        if (!empty($parts)) {
            return $parts[0] . ".min.css";
        } else
            return $jsLink;
    } else
        return $jsLink;
}

function echoJS($jsLink)
{
    echo "<script src=\"" . $jsLink . "\"></script>";
    if (!MINIFY_DEPENDENCIES_HTML)
        echo("\n");
}

function echoCSS($jsLink)
{
    echo "<link rel=\"stylesheet\" href=\"" . $jsLink . "\">";
    if (!MINIFY_DEPENDENCIES_HTML)
        echo("\n");
}