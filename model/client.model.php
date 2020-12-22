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
	}
