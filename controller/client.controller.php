<?php
	class ClientController{
		static public function ctrCreateClient(){
			if(isset($_POST["newName"])){
				if(preg_match('/\P{Myanmar}+$/',$_POST["newName"])
			 /*preg_match('/^[()\-0-9 ]+$/', $_POST["newPhone"])*/){

/*
						if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCustomer"]) &&
			   preg_match('/^[0-9]+$/', $_POST["newIdDocument"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["newEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["newPhone"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["newAddress"])){*/
					$table="client";
					$data = array("name"=>$_POST["newName"],
					           "document_id"=>$_POST["newDocumentId"],
					           "email"=>$_POST["newEmail"],
					           "phone"=>$_POST["newPhone"],
					           "address"=>$_POST["newAddress"],
					           "birth_date"=>$_POST["newBirthDate"]);

			   	$answer = ModelClient::mdlCreateClient($table, $data);

			   	if($answer == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "The customer has been saved",
						  showConfirmButton: true,
						  confirmButtonText: "Ok"
						  }).then(function(result){
									if (result.value) {

									window.location = "client";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Customer cannot be blank or especial characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "client";

							}
						})

			  	</script>';

			}
			}

		}

		static public function ctrShowClient($item,$value){
			$table="client";
			$answer=ModelClient::mdlShowCLient($table,$item,$value);
			return $answer;

		}
		static public function ctrEditClient(){
			if(isset($_POST["editName"])){
			if(preg_match('/\P{Myanmar}+$/',$_POST["editName"])) {

				$table="client";
				$data=array("id"=>$_POST["idClient"],
					"name"=>$_POST["editName"],
					"document_id"=>$_POST["editDocumentId"],
					"email"=>$_POST["editEmail"],
					"phone"=>$_POST["editPhone"],
					"address"=>$_POST["editAddress"],
					"birth_date"=>$_POST["editBirthDate"]);
	


				$answer=ModelClient::mdlEditClient($table,$data);

					if($answer == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "Client was saved",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "client";
							}

						});
					
				</script>';
			 	}






			}else{
				echo '<script>
					
					swal({
						type: "error",
						title: "Name cant be empty or special character",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "client";
							}

						});
					
					</script>';
			}

			}
		}

		static public function ctrDeleteClient(){
			if(isset($_GET["id"])){
			$table="client";
			$data=$_GET["id"];


			$resquest=ModelClient::mdlDeleteClient($table,$data);

				if($resquest == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "Client was delete",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "client";
							}

						});
					
				</script>';
			 	}
		}
		}
	}



