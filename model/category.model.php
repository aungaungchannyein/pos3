<?php 
require_once "connection.php";

	class ModelCategory{

		static public function mdlCreateCategory($table,$data){


			$stmt=Connection::Connector()->prepare("INSERT INTO $table(category) VALUES(:category) ");
			$stmt-> bindParam(":category",$data,PDO::PARAM_STR);
			

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";


		}

		static public function mdlShowCategory($table,$item,$value){

			if($item!=null){
				$stmt=Connection::Connector()->prepare("SELECT * FROM $table WHERE $item=:$item");
				$stmt-> bindParam(":".$item,$value,PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetch();
				



			}else{
				$stmt=Connection::Connector()->prepare("SELECT * from $table");
			
				$stmt->execute();

				return $stmt->fetchAll();

			}


			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			




		}

		static public function mdlEditCategory($table,$data){

			$stmt=Connection::Connector()->prepare("UPDATE $table SET category=:category WHERE id=:id");

			$stmt-> bindParam(":id",$data["id"],PDO::PARAM_STR);
			$stmt-> bindParam(":category",$data["category"],PDO::PARAM_STR);

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
			$stmt=null;



		}
		static public function mdlDeleteCategory($table,$data){
			 
			$stmt=Connection::Connector()->prepare("DELETE FROM $table WHERE id=:id");

			$stmt-> bindParam(":id",$data,PDO::PARAM_STR);

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
			$stmt=null;




		}
		

	}
