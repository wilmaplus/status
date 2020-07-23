<?php
/**
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */


/**
 * Check if host is alive
 * @param $url
 * @return bool
 */
function getHostStatus($url)
{
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $jsondecoded = json_decode($response, true);
        if ($jsondecoded != null && is_array($jsondecoded)) {
            if (array_key_exists("status", $jsondecoded)) {
                return $jsondecoded['status'];
            }
        } else {
            if ($response == "OK") {
                return true;
            }
        }
        return false;
    } catch (Exception $ignored) {
        return false;
    }

}

