<?php 
	
	require_once "controller/template.controller.php";
	require_once "controller/user.controller.php";
	require_once "controller/client.controller.php";
	require_once "controller/product.controller.php";
	require_once "controller/category.controller.php";
	require_once "controller/sale.controller.php";

	require_once "model/user.model.php";
	require_once "model/client.model.php";
	require_once "model/product.model.php";
	require_once "model/category.model.php";
	require_once "model/sale.model.php";
	//require_once "extensions/vendor/autoload.php";

	$template=new ControllerTemplate();
	$template->ctrTemplate();