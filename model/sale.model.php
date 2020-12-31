<?php 
	class ModelSale{
		static public function mdlShowSale($table,$item,$value){
			if($item!=null){
				$stmt=Connection::Connector()->prepare("SELECT * FROM $table WHERE $item=:$item ORDER BY date DESC");
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

		static public function mdlAddSale($table, $data){

		$stmt = Connection::Connector()->prepare("INSERT INTO $table(code, id_client, id_seller, product, tax, net_price, total, payment_method) VALUES (:code, :id_client, :id_seller, :product, :tax, :net_price, :total, :payment_method)");




		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":id_client", $data["id_client"], PDO::PARAM_INT);
		$stmt->bindParam(":id_seller", $data["id_seller"], PDO::PARAM_INT);
		$stmt->bindParam(":product", $data["product"], PDO::PARAM_STR);
		$stmt->bindParam(":tax", $data["tax"], PDO::PARAM_STR);
		$stmt->bindParam(":net_price", $data["net_price"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $data["total"], PDO::PARAM_STR);
		$stmt->bindParam(":payment_method", $data["payment_method"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
			}
	}

