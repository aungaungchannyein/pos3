<?php 
	class ModelSale{
		static public function mdlShowSale($table,$item,$value){
			if($item!=null){
				$stmt=Connection::Connector()->prepare("SELECT * FROM $table WHERE $item=:$item ORDER BY id ASC");
				$stmt-> bindParam(":".$item,$value,PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetch();
				



			}else{
				$stmt=Connection::Connector()->prepare("SELECT * from $table ORDER BY id ASC");
			
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

		static public function mdlEditSale($table, $data){

				$stmt = Connection::Connector()->prepare("UPDATE $table SET  id_client = :id_client, id_seller = :id_seller, product = :product, tax = :tax, net_price = :net_price, total= :total, payment_method = :payment_method WHERE code = :code");

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

		static public function mdlDeleteSale($table,$data){
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

		static public function mdlSalesDatesRange($table, $initialDate, $finalDate){

		if($initialDate == null){

			$stmt = Connection::Connector()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($initialDate == $finalDate){

			$stmt =  Connection::Connector()->prepare("SELECT * FROM $table WHERE saledate like '%$finalDate%'");

			$stmt -> bindParam(":saledate", $finalDate, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$actualDate = new DateTime();
			$actualDate ->add(new DateInterval("P1D"));
			$actualDatePlusOne = $actualDate->format("Y-m-d");

			$finalDate2 = new DateTime($finalDate);
			$finalDate2 ->add(new DateInterval("P1D"));
			$finalDatePlusOne = $finalDate2->format("Y-m-d");

			if($finalDatePlusOne == $actualDatePlusOne){

			$stmt =  Connection::Connector()->prepare("SELECT * FROM $table WHERE saledate BETWEEN '$initialDate' AND '$finalDatePlusOne'");

			}else{


				$stmt =  Connection::Connector()->prepare("SELECT * FROM $table WHERE saledate BETWEEN '$initialDate' AND '$finalDate'");

		 	}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		 }

	}

}

	

