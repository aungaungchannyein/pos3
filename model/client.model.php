<?php

	require_once "connection.php";
	class ModelClient{
		static public function mdlCreateClient($table,$data){

			$stmt=Connection::Connector()->prepare("INSERT INTO $table(name,document_id,email,phone,address,birth_date) VALUES(:name,:document_id,:email,:phone,:address,:birth_date)");
				$stmt-> bindParam(":name",$data["name"],PDO::PARAM_STR);
				$stmt-> bindParam(":document_id",$data["document_id"],PDO::PARAM_STR);
				$stmt-> bindParam(":email",$data["email"],PDO::PARAM_STR);
				$stmt-> bindParam(":phone",$data["phone"],PDO::PARAM_STR);
				$stmt-> bindParam(":address",$data["address"],PDO::PARAM_STR);
				$stmt-> bindParam(":birth_date",$data["birth_date"],PDO::PARAM_STR);

				if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
			$stmt=null;

		}

		static public function mdlShowCLient($table,$item,$value){
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

		static public function mdlEditClient($table,$data){
			$stmt=Connection::Connector()->prepare("UPDATE $table SET id=:id,name=:name,document_id=:document_id,email=:email,phone=:phone,address=:address,birth_date=:birth_date WHERE id=:id");

			$stmt-> bindParam(":id",$data["id"],PDO::PARAM_STR);
			$stmt-> bindParam(":name",$data["name"],PDO::PARAM_STR);
			$stmt-> bindParam(":document_id",$data["document_id"],PDO::PARAM_STR);
			$stmt-> bindParam(":email",$data["email"],PDO::PARAM_STR);
			$stmt-> bindParam(":phone",$data["phone"],PDO::PARAM_STR);
			$stmt-> bindParam(":address",$data["address"],PDO::PARAM_STR);
			$stmt-> bindParam(":birth_date",$data["birth_date"],PDO::PARAM_STR);

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
			$stmt=null;

		}

		static public function mdlDeleteClient($table,$data){
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

		static public function mdlActivateClient($table,$item1,$value1,$value2){

			$stmt=Connection::Connector()->prepare("UPDATE $table SET $item1=:$item1 WHERE id=:id");

			$stmt-> bindParam(":".$item1,$value1,PDO::PARAM_STR);
			$stmt-> bindParam(":id",$value2,PDO::PARAM_STR);
		

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
			$stmt=null;

		}
	}
