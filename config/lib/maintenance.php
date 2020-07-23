<?php
/**
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */


/**
 * Adding done boolean to the maintenance
 * @param $maintenance array
 * @return array
 */
function maintenanceToApiFormat($maintenance)
{
    $doneDate = DateTime::createFromFormat("Y-m-d H:i:s", $maintenance['end']);
    $done = (new DateTime() > $doneDate);
    $maintenance['done'] = $done;
    return $maintenance;
}

