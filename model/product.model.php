<?php

	require_once "connection.php";

	class ModelProduct{

		static public function mdlShowProduct($table,$item,$value){

			if($item!=null){

				$stmt=Connection::Connector()->prepare("SELECT * from $table WHERE $item=:$item ORDER BY id DESC");
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
	}