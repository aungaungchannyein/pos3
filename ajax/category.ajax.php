<?php 

	require_once "../controller/category.controller.php";
	require_once "../model/category.model.php";

	class AjaxCategory{

		public $idCategory;
		public function ajaxEditCategory(){

			$item="id";
			$value=$this->idCategory;

			$response=CategoryController::ctrShowCategory($item,$value);

			echo json_encode($response);
		}
	}
	if(isset($_POST['idCategory'])){
		$editCategory=new AjaxCategory();
		$editCategory->idCategory=$_POST["idCategory"];
		$editCategory->ajaxEditCategory();
	}