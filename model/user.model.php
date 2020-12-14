<?php
	require_once "connection.php";

	class ModelUser{

		static public function MdlShowUser($table,$item,$value){

			if($item!=null)
			{

				$stmt=Connection::Connector()->prepare("SELECT * from $table WHERE $item=:$item");
				$stmt-> bindParam(":".$item,$value,PDO::PARAM_STR);
				$stmt->execute();

				return $stmt->fetch();
				

			}else{
				$stmt=Connection::Connector()->prepare("SELECT * from $table");
			
				$stmt->execute();

				return $stmt->fetchAll();
			
				}
			$stmt->close();
				$stmt=null;

			

		}

		static public function MdlAddUser($table,$data){

			$stmt=Connection::Connector()->prepare("INSERT INTO $table(name,user,password,profile,photo) VALUES(:name,:user,:password,:profile,:photo) ");
			$stmt-> bindParam(":name",$data["name"],PDO::PARAM_STR);
			$stmt-> bindParam(":user",$data["user"],PDO::PARAM_STR);
			$stmt-> bindParam(":password",$data["password"],PDO::PARAM_STR);
			$stmt-> bindParam(":profile",$data["profile"],PDO::PARAM_STR);
			$stmt-> bindParam(":photo",$data["photo"],PDO::PARAM_STR);

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

		}

		static public function MdlEditUser($table,$data){

			$stmt=Connection::Connector()->prepare("UPDATE $table SET name=:name,password=:password,profile=:profile,photo=:photo WHERE user=:user");
			$stmt-> bindParam(":name",$data["name"],PDO::PARAM_STR);
			$stmt-> bindParam(":user",$data["user"],PDO::PARAM_STR);

			$stmt-> bindParam(":password",$data["password"],PDO::PARAM_STR);
			$stmt-> bindParam(":profile",$data["profile"],PDO::PARAM_STR);
			$stmt-> bindParam(":photo",$data["photo"],PDO::PARAM_STR);

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
			$stmt=null;

		}
		static public function mdlActivateUser($table,$item1,$value1,$item2,$value2){

			$stmt=Connection::Connector()->prepare("UPDATE $table SET $item1=:$item1 WHERE $item2=:$item2");

			$stmt-> bindParam(":".$item1,$value1,PDO::PARAM_STR);
			$stmt-> bindParam(":".$item2,$value2,PDO::PARAM_STR);

			if($stmt->execute())
			{
				return "ok";
			}else
				return "error";

			$stmt->close();
			$stmt=null;

		}

		static public function mdlDeleteUser($table,$data){

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
