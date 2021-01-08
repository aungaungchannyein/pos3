<?php

require_once "../../controller/sale.controller.php";
require_once "../../model/sale.model.php";
require_once "../../controller/client.controller.php";
require_once "../../model/client.model.php";
require_once "../../controller/user.controller.php";
require_once "../../model/user.model.php";

$report = new SaleController();
$report -> ctrDownloadReport();