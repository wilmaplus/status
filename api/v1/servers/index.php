<?php
/**
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */

require dirname(dirname(dirname(__DIR__))) . "/config/config.php";

header('Content-type:application/json;charset=utf-8');

$status = null;
if (file_exists(__DIR__ . "/.cache") && is_dir(__DIR__ . "/.cache")) {
    if (file_exists(__DIR__ . "/.cache/status.json")) {
        $status = json_decode(file_get_contents(__DIR__ . "/.cache/status.json"), true);

    } else
        throwError(500, "cache_not_ready");
} else
    throwError(500, "Cache folder is missing");


