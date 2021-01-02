<?php

	require_once "connection.php";

	class ModelProduct{

		static public function mdlShowProduct($table,$item,$value){

			if($item!=null){

				$stmt=Connection::Connector()->prepare("SELECT * from $table WHERE $item=:$item ");
				//ORDER BY id DESC
				$stmt-> bindParam(":".$item,$value,PDO::PARAM_STR);
				$stmt->execute();

				return $stmt->fetch();


			}else{

				$stmt=Connection::Connector()->prepare("SELECT * FROM $table");
				$stmt->bindParam(":".$item,$value,PDO::PARAM_STR);
				$stmt->execute();

				return $stmt->fetchAll();

			}
				$stmt->close();
				$stmt=null;
		}

		static public function mdlAddProduct($table,$data){

			$stmt=Connection::Connector()->prepare("INSERT INTO $table(id_category,code,description,photo,stock,buying_price,selling_price) VALUES(:id_category,:code,:description,:photo,:stock,:buying_price,:selling_price) ");
			$stmt-> bindParam(":id_category",$data["id_category"],PDO::PARAM_STR);
			$stmt-> bindParam(":code",$data["code"],PDO::PARAM_STR);
			$stmt-> bindParam(":description",$data["description"],PDO::PARAM_STR);
			$stmt-> bindParam(":photo",$data["photo"],PDO::PARAM_STR);
			$stmt-> bindParam(":stock",$data["stock"],PDO::PARAM_STR);
			$stmt-> bindParam(":buying_price",$data["buying_price"],PDO::PARAM_STR);
			$stmt-> bindParam(":selling_price",$data["selling_price"],PDO::PARAM_STR);

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
				$stmt=null;

		}

		static public function mdlEditProduct($table,$data){

			$stmt=Connection::Connector()->prepare("UPDATE  $table SET id_category=:id_category, code=:code, description=:description, photo=:photo,stock=:stock,buying_price=:buying_price,selling_price=:selling_price WHERE  code=:code");
			$stmt-> bindParam(":id_category",$data["id_category"],PDO::PARAM_STR);
			$stmt-> bindParam(":code",$data["code"],PDO::PARAM_STR);
			$stmt-> bindParam(":description",$data["description"],PDO::PARAM_STR);
			$stmt-> bindParam(":photo",$data["photo"],PDO::PARAM_STR);
			$stmt-> bindParam(":stock",$data["stock"],PDO::PARAM_STR);
			$stmt-> bindParam(":buying_price",$data["buying_price"],PDO::PARAM_STR);
			$stmt-> bindParam(":selling_price",$data["selling_price"],PDO::PARAM_STR);

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
				$stmt=null;

		}

		static public function mdlDeleteProduct($table,$data){

			
			$stmt=Connection::Connector()->prepare("DELETE FROM $table WHERE id=:id");

			$stmt-> bindParam(":id",$data,PDO::PARAM_INT);

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
			$stmt=null;


		}

		static public function mdlActivateProduct($table,$item1,$value1,$value2){

			$stmt=Connection::Connector()->prepare("UPDATE $table SET $item1=:$item1 WHERE id=:id");

			$stmt-> bindParam(":".$item1,$value1,PDO::PARAM_STR);
			$stmt-> bindParam(":id",$value2,PDO::PARAM_INT);
		

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
			$stmt=null;

		}
	}