<?php 

	require_once "../controller/client.controller.php";
	require_once "../model/client.model.php";

	class AjaxClient{

		public $idClient;
		public function ajaxEditClient(){

			$item="id";
			$value=$this->idClient;

			$response=ClientController::ctrShowClient($item,$value);

			echo json_encode($response);
		}
	}
	if(isset($_POST['idClient'])){
		$editClient=new AjaxClient();
		$editClient->idClient=$_POST["idClient"];
		$editClient->ajaxEditClient();
	}