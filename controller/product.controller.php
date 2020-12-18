<?php

class ProductController{

	static public function ctrShowProduct($item,$value){
		
		$table="product";
		$answer=ModelProduct::mdlShowProduct($table,$item,$value);
		return $answer;

	}

	static public function ctrCreateProduct(){
		if(isset($_POST["newDescription"])){
			if(preg_match('/\P{Myanmar}+$/',$_POST["newDescription"]) &&
			 preg_match('/^[0-9]+$/',$_POST["newStock"]) && 
			 preg_match('/^[0-9.]+$/',$_POST["newBuyprice"]) && 
			 preg_match('/^[0-9.]+$/',$_POST["newSaleprice"])) {

			 	$photo="view/img/products/default/anonymous.png";

			 	if(isset($_FILES["newPhoto"]["tmp_name"]))
			 	{

			 		list($width,$height)=getimagesize($_FILES["newPhoto"]["tmp_name"]);

			 		$newWidth=500;
			 		$newHeight=500;

			 		$folder="view/img/products/".$_POST["newCode"];

			 		mkdir($folder, 0755);

			 		if($_FILES["newPhoto"]["type"]=="image/jpeg")
			 		{

			 			$randomNumber=mt_rand(100,999);
			 			$photo="view/img/products/".$_POST["newCode"]."/".$randomNumber.".jpg";
			 			$srcImage=imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);
			 			$destination=imagecreatetruecolor($newWidth, $newHeight);
			 			imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight,$width,$height);
			 			imagejpeg($destination,$photo);

			 		}

			 		if($_FILES["newPhoto"]["type"]=="image/png")
			 		{

			 			$randomNumber=mt_rand(100,999);
			 			$photo="view/img/products/".$_POST["newCode"]."/".$randomNumber.".png";
			 			$srcImage=imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);
			 			$destination=imagecreatetruecolor($newWidth, $newHeight);
			 			imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight,$width,$height);
			 			imagepng($destination,$photo);

			 		}
				}


			$table="product";
			$data=array("id_category"=>$_POST["newCategory"],
			 				"code"=>$_POST["newCode"],
			 				"description"=>$_POST["newDescription"],
			 				"stock"=>$_POST["newStock"],
			 				"buying_price"=>$_POST["newBuyprice"],
			 				"selling_price"=>$_POST["newSaleprice"],
			 				"photo"=>$photo
			 				);
			$answer=ModelProduct::mdlAddProduct($table,$data);

			if($answer == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "Product was saved",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "product";
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

								window.location = "product";
							}

						});
					
					</script>';
				}
		}
	}

	static public function ctrEditProduct(){

		if(isset($_POST["editDescription"])){
			if(preg_match('/\P{Myanmar}+$/',$_POST["editDescription"]) &&
			 preg_match('/^[0-9]+$/',$_POST["editStock"]) && 
			 preg_match('/^[0-9.]+$/',$_POST["editBuyprice"]) && 
			 preg_match('/^[0-9.]+$/',$_POST["editSaleprice"])) {

			 	$photo=$_POST["currentPhoto"];

			 	if(isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"])){

					list($width, $height) = getimagesize($_FILES["editPhoto"]["tmp_name"]);

					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					WE CREATE THE FOLDER WHERE WE WILL SAVE THE PRODUCT IMAGE
					=============================================*/

					$folder = "view/img/products/".$_POST["editCode"];

					/*=============================================
					WE ASK IF WE HAVE ANOTHER PICTURE IN THE DB
					=============================================*/

					if(!empty($_POST["currentPhoto"]) && $_POST["currentPhoto"] != "view/img/products/default/anonymous.png"){

						unlink($_POST["currentPhoto"]);

					}else{

						mkdir($folder, 0755);	
					
					}

			 		if($_FILES["editPhoto"]["type"]=="image/jpeg")
			 		{

			 			$randomNumber=mt_rand(100,999);
			 			$photo="view/img/products/".$_POST["editCode"]."/".$randomNumber.".jpg";
			 			$srcImage=imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);
			 			$destination=imagecreatetruecolor($newWidth, $newHeight);
			 			imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight,$width,$height);
			 			imagejpeg($destination,$photo);

			 		}

			 		if($_FILES["editPhoto"]["type"]=="image/png")
			 		{

			 			$randomNumber=mt_rand(100,999);
			 			$photo="view/img/products/".$_POST["editCode"]."/".$randomNumber.".png";
			 			$srcImage=imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);
			 			$destination=imagecreatetruecolor($newWidth, $newHeight);
			 			imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight,$width,$height);
			 			imagepng($destination,$photo);

			 		}
				}


			$table="product";
			$data=array("id_category"=>$_POST["editCategory"],
			 				"code"=>$_POST["editCode"],
			 				"description"=>$_POST["editDescription"],
			 				"stock"=>$_POST["editStock"],
			 				"buying_price"=>$_POST["editBuyprice"],
			 				"selling_price"=>$_POST["editSaleprice"],
			 				"photo"=>$photo
			 				);
			$answer=ModelProduct::mdlEditProduct($table,$data);

			if($answer == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "Product was saved",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "product";
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

								window.location = "product";
							}

						});
					
					</script>';
				}
	
		}	
	}

	static public function ctrDeleteProduct(){

		if(isset($_GET["id"])){
			$table="product";
			$data=$_GET["id"];

		

			if($_GET["photo"] != "" && $_GET["photo"] != "view/img/products/default/anonymous.png"){
				unlink($_GET["photo"]);
				rmdir('view/img/products/'.$_GET["code"]);

			}
			$answer=ModelProduct::mdlDeleteProduct($table,$data);

				if($answer == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "User was delete",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "product";
							}

						})
					
				</script>';
			 	}
		}

	}

}



