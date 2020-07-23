<?php
/**
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */

require __DIR__."/config/config.php";
require __DIR__."/components/dependencies.php";
require __DIR__."/components/head.php";
?>


    <div ng-controller="WebCtl" id="popupContainer" ng-cloak="" ng-app="wilmaplus-status" style="width: 100% "
         layout-fill>
        <div ng-view layout-fill></div>
    </div>


<?php
require __DIR__."/components/footer.php";
