<?php 
require_once "../controller/product.controller.php";
require_once "../model/product.model.php";

class AjaxProduct{
	public function ajaxCreateCodeProduct(){

		$item="id_category";
		$value=$this->idCategory;
		$answer=ProductController::ctrShowProduct($item,$value);

		echo json_encode($answer);


	}

	public function ajaxEditProduct(){

		$item="id";
		$value=$this->idProduct;
		$answer=ProductController::ctrShowProduct($item,$value);

		echo json_encode($answer);

	}
}

if(isset($_POST["idCategory"])){
	$codeProduct= new AjaxProduct();
	$codeProduct-> idCategory=$_POST["idCategory"];
	$codeProduct-> ajaxCreateCodeProduct();
}

if(isset($_POST["idProduct"])){
	$editProduct= new AjaxProduct();
	$editProduct-> idProduct=$_POST["idProduct"];
	$editProduct-> ajaxEditProduct();
}