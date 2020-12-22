<?php

class UserController
{
		static public function ctrLogin()
	{
		if(isset($_POST["username"]))
		{
			if(preg_match('/^[a-zA-Z0-9]+$/',$_POST["username"]) &&
			 (preg_match('/^[a-zA-Z0-9]+$/',$_POST["password"])))
			 {

			 	$encryptpass = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
		

			 	$table="user";

			 	$item="user";
			 	$value=$_POST["username"];
			 	$answer= ModelUser::MdlShowUser($table,$item,$value);
			 	if($answer["user"]==$_POST["username"] && $answer["password"]==$encryptpass ){

			 		if($answer["status"]==1){

			 			$_SESSION["beginSession"]="ok";
			 		$_SESSION["id"]=$answer["id"];
			 		$_SESSION["name"]=$answer["name"];
			 		$_SESSION["user"]=$answer["user"];
			 		$_SESSION["photo"]=$answer["photo"];
			 		$_SESSION["profile"]=$answer["profile"];



			 		date_default_timezone_set('Asia/Yangon');

			 		$date=date('Y-m-d');
			 		$hour=date('H:i:s');

			 		$currentDate=$date.' '.$hour;

			 		$item1="lastLogin";
			 		$value1=$currentDate;

			 		$item2="id";
			 		$value2=$answer["id"];

			 		$lastLogin=ModelUser::mdlActivateUser($table,$item1,$value1,$item2,$value2);
			 		 if($lastLogin=="ok"){

			 		 	echo '<script>
			 			window.location="home";
			 			</script>';


			 		 }




			 		

			 		}else{

			 		echo '<div class="alert alert-danger">User is not activated!</div>';

			 	}

			 		
			 	}else{

			 		echo '<div class="alert alert-danger">Error on login,try again</div>';

			 	}

			}

		}
	}

	static public function ctrCreateUser()
	{
		if(isset($_POST["newUser"]))
		{
			if(preg_match('/^[ a-zA-Z0-9]+$/',$_POST["newName"]) &&
			 (preg_match('/^[a-zA-Z0-9]+$/',$_POST["newUser"])) &&
			 (preg_match('/^[a-zA-Z0-9]+$/',$_POST["newPassword"])))
			{
				$photo = "";

			 	if(isset($_FILES["newPhoto"]["tmp_name"]))
			 	{

			 		list($width,$height)=getimagesize($_FILES["newPhoto"]["tmp_name"]);

			 		$newWidth=500;
			 		$newHeight=500;

			 		$folder="view/img/users/".$_POST["newUser"];

			 		mkdir($folder, 0755);

			 		if($_FILES["newPhoto"]["type"]=="image/jpeg")
			 		{

			 			$randomNumber=mt_rand(100,999);
			 			$photo="view/img/users/".$_POST["newUser"]."/".$randomNumber.".jpg";
			 			$srcImage=imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);
			 			$destination=imagecreatetruecolor($newWidth, $newHeight);
			 			imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight,$width,$height);
			 			imagejpeg($destination,$photo);

			 		}

			 		if($_FILES["newPhoto"]["type"]=="image/png")
			 		{

			 			$randomNumber=mt_rand(100,999);
			 			$photo="view/img/users/".$_POST["newUser"]."/".$randomNumber.".png";
			 			$srcImage=imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);
			 			$destination=imagecreatetruecolor($newWidth, $newHeight);
			 			imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight,$width,$height);
			 			imagepng($destination,$photo);

			 		}
				}

			 	$table="user";

			 	$encryptpass = crypt($_POST["newPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');


			 	$data=array("name"=>$_POST["newName"],
			 				"user"=>$_POST["newUser"],
			 				"password"=>$encryptpass,
			 				"profile"=>$_POST["newProfile"],
			 				"photo"=>$photo
			 				);
			 	$answer=ModelUser::MdlAddUser($table,$data);
			 	if($answer == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "User was saved",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "user";
							}

						});
					
				</script>';
			 	}


			}else{

				echo '<script>
					
					swal({
						type: "error",
						title: "No special characters or blank fields",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "user";
							}

						});
					
					</script>';
				}

		}
	}

	static public function ctrShowUser($item,$value){

		$table="user";
		$answer= ModelUser::MdlShowUser($table,$item,$value);
		return $answer;

	}

	static public function ctrEditUser(){
		if(isset($_POST["editUser"])){
			if(preg_match('/^[ a-zA-Z0-9]+$/',$_POST["editName"]))
			{
				$photo=$_POST["currentPhoto"];
				


				if(isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"]))
			 	{

			 		list($width,$height)=getimagesize($_FILES["editPhoto"]["tmp_name"]);

			 		$newWidth=500;
			 		$newHeight=500;

			 		$folder="view/img/users/".$_POST["editUser"];

			 		if(!empty($_POST["currentPhoto"])){

			 			unlink($_POST["currentPhoto"]);

			 		}else{

			 			mkdir($folder, 0755);

			 		}

			 		

			 		if($_FILES["editPhoto"]["type"]=="image/jpeg")
			 		{

			 			$randomNumber=mt_rand(100,999);
			 			$photo="view/img/users/".$_POST["editUser"]."/".$randomNumber.".jpg";
			 			$srcImage=imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);
			 			$destination=imagecreatetruecolor($newWidth, $newHeight);
			 			imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight,$width,$height);
			 			imagejpeg($destination,$photo);

			 		}

			 		if($_FILES["editPhoto"]["type"]=="image/png")
			 		{

			 			$randomNumber=mt_rand(100,999);
			 			$photo="view/img/users/".$_POST["editUser"]."/".$randomNumber.".png";
			 			$srcImage=imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);
			 			$destination=imagecreatetruecolor($newWidth, $newHeight);
			 			imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight,$width,$height);
			 			imagepng($destination,$photo);

			 		}
				}

				$table="user";

				if($_POST["editPassword"]!=""){
					if(preg_match('/^[a-zA-Z0-9]+$/',$_POST["editPassword"])){

						$encryptpass = crypt($_POST["editPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo '<script>
					
					swal({
						type: "error",
						title: "Password cannot special character",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "user";
							}

						});
					
					</script>';

					}

					

				}else{

					$encryptpass=$_POST["currentPassword"];

				}

				$data=array("name"=>$_POST["editName"],
			 				"user"=>$_POST["editUser"],
			 				"password"=>$encryptpass,
			 				"profile"=>$_POST["editProfile"],
			 				"photo"=>$photo);

				$answer=ModelUser::MdlEditUser($table,$data);

				if($answer == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "User was saved",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "user";
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

								window.location = "user";
							}

						});
					
					</script>';
			}

		}
	}	

	static public function ctrDeleteUser(){

		if(isset($_GET['id'])){
			$table="user";
			$data=$_GET["id"];

			if($_GET["photo"]!=""){
				unlink($_GET["photo"]);
				rmdir('view/img/users/'.$_GET["user"]);
			}

			$resquest=ModelUser::mdlDeleteUser($table,$data);

				if($resquest == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "User was delete",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "user";
							}

						});
					
				</script>';
			 	}
		}

	}
}


