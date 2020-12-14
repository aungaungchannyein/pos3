<?php
	require_once "../controller/user.controller.php";
	require_once "../model/user.model.php";

	class AjaxUser{

		public $idUser;
		public function ajaxEditUser(){

			$item="id";
			$value=$this->idUser;

			$response=UserController::ctrShowUser($item,$value);

			echo json_encode($response);

		}

		public $activateId;
		public $activateUser;
		public function ajaxActivateUser(){

			$table="user";
			$item1="status";
			$value1=$this->activateUser;
			$item2="id";
			$value2=$this->activateId;

			$answer=ModelUser::mdlActivateUser($table,$item1,$value1,$item2,$value2);

			echo json_encode($answer);



		}

		public $validateUser;
		public function ajaxValidateUser(){

			$item="user";
			$value=$this->validateUser;

			$response=UserController::ctrShowUser($item,$value);

			echo json_encode($response);

		}


	}
if(isset($_POST['idUser'])){
	$edit= new AjaxUser();
	$edit -> idUser=$_POST["idUser"];
	$edit -> ajaxEditUser();
}


if(isset($_POST['activateUser'])){
	$activateUser= new AjaxUser();
	
	$activateUser -> activateUser=$_POST["activateUser"];
	$activateUser -> activateId=$_POST["activateId"];
	$activateUser -> ajaxActivateUser();
}

if(isset($_POST['validateUser'])){
	$validateUser=new AjaxUser();
	$validateUser-> validateUser=$_POST["validateUser"];
	$validateUser-> ajaxValidateUser();
}