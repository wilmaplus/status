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
    array_push($serverStatus, $server);
}

$date = new DateTime();
$status = array("servers" => $serverStatus, "refreshed" => $date->format("Y-m-d H:i:s"));
file_put_contents(__DIR__ . "/status.json", json_encode($status));

echo "[ OK ] Cache\n";
exit;