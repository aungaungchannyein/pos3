<?php

class CategoryController{

    
	static public function ctrCreateCategory(){

		if(isset($_POST["newCategory"]))
		{
			if(preg_match('/\P{Myanmar}+$/',$_POST["newCategory"])) {

			$table="category";
			$data=$_POST["newCategory"];

			$answer=ModelCategory::mdlCreateCategory($table,$data);

			if($answer == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "Category was saved",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "category";
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

								window.location = "category";
							}

						});
					
					</script>';
				}


			}
			

	}

	static public function ctrShowCategory($item,$value){


		$table="category";
		$answer= ModelCategory::mdlShowCategory($table,$item,$value);
		return $answer;
	}

	static public function ctrEditCategory(){

		if(isset($_POST["editCategory"])){
			if(preg_match('/\P{Myanmar}+$/',$_POST["editCategory"])) {

				$table="category";
				$data=array("id"=>$_POST["idCategory"],"category"=>$_POST["editCategory"]);
				 var_dump($data);


				$answer=ModelCategory::mdlEditCategory($table,$data);

					if($answer == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "Category was saved",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "category";
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

								window.location = "category";
							}

						});
					
					</script>';
			}

			}
		}

	static public function ctrDeleteCategory(){

		if(isset($_GET["id"])){
			$table="category";
			$data=$_GET["id"];


			$resquest=ModelCategory::mdlDeleteCategory($table,$data);

				if($resquest == "ok"){
			 			echo '<script>
					
					swal({
						type: "success",
						title: "Category was delete",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "category";
							}

						});
					
				</script>';
			 	}
		}
	}

}

