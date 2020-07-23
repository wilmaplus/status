<?php
/**
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */


require dirname(dirname(dirname(dirname(__DIR__)))) . "/config/config.php";

$serverStatus = array();

foreach (SERVERS as $server) {
    $hostStatus = getHostStatus($server['checkurl']);
    unset($server['checkurl']);
    $server['available'] = $hostStatus;
}