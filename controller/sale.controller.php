<?php

class SaleController{
	static public function ctrShowSale($item,$value){
		$table="sale";
		$answer=ModelSale::mdlShowSale($table,$item,$value);
		return $answer;
	}
	static public function ctrCreateSale(){

		if(isset($_POST["newSale"])){

			$listproduct=json_decode($_POST["productsList"],true);

			$totalPurchasedProducts = array();

			foreach ($listproduct as $key => $value) {

			array_push($totalPurchasedProducts,$value["quantity"]);

				$tableProduct="product";
				$item="id";
				$valueProductId=$value["id"];
				$getProduct = ModelProduct::mdlShowProduct($tableProduct, $item, $valueProductId);

				

				$item1a="sold_quantity";
				$value1a=$value["quantity"]+$getProduct["sold_quantity"];
				$newSale=ModelProduct:: mdlActivateProduct($tableProduct,$item1a,$value1a,$valueProductId);

				$item1b="stock";
				$value1b=$value["stock"];
				$newStock=ModelProduct:: mdlActivateProduct($tableProduct,$item1b,$value1b,$valueProductId);

			}

			$tableCustomer = "client";

			$item="id";
			$valueCustomer = $_POST["selectCustomer"];
			$getCustomer = ModelClient::mdlShowCLient($tableCustomer, $item, $valueCustomer);
			

			$item1a = "total_purchase";
			$value1a = array_sum($totalPurchasedProducts) + $getCustomer["total_purchase"];

			$customerPurchases = ModelClient::mdlActivateClient($tableCustomer, $item1a, $value1a, $valueCustomer);

			$item1b = "last_purchase";

			date_default_timezone_set('Asia/Yangon');

			$date = date('Y-m-d');
			$hour = date('H:i:s');
			$value1b = $date.' '.$hour;

			$dateCustomer = ModelClient::mdlActivateClient($tableCustomer, $item1b, $value1b, $valueCustomer);

			$table="sale";
			$data = array("id_seller"=>$_POST["idSeller"],
						   "id_client"=>$_POST["selectCustomer"],
						   "code"=>$_POST["newSale"],
						   "product"=>$_POST["productsList"],
						   "tax"=>$_POST["newTaxPrice"],
						   "net_price"=>$_POST["newNetPrice"],
						   "total"=>$_POST["saleTotal"],
						   "payment_method"=>$_POST["listPaymentMethod"]);

			$answer = ModelSale::mdlAddSale($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "The sale has been succesfully added",
					  showConfirmButton: true,
					  confirmButtonText: "OK"
					  }).then((result) => {
								if (result.value) {

								window.location = "create-sale";

								}
							})

				</script>';

			}





		}

	}

	static public function ctrEditSale(){

		if(isset($_POST["editSale"])){

			$table = "sale";

			$item = "code";
			$value = $_POST["editSale"];

			$getSale = ModelSale::mdlShowSale($table, $item, $value);

			

			if($_POST["productsList"]==""){
				$productsList=$getSale["product"];
				$productChange = false;
			}else{
				$productsList=$_POST["productsList"];
				$productChange = true;
			}

			if($productChange){



			$listproduct=json_decode($getSale["product"],true);

			$totalPurchasedProducts = array();

			//var_dump("tttttttttt",$listproduct);

			foreach ($listproduct as $key => $value){
				//var_dump("tttttttttt",$value["quantity"]);
				
				array_push($totalPurchasedProducts,$value["quantity"]);

			 	$tableProduct="product";
				$item="id";
			 	$valueProductId=$value["id"];
			 	$getProduct = ModelProduct::mdlShowProduct($tableProduct, $item, $valueProductId);


			 	$item1a = "sold_quantity";
			 	
			 	//var_dump("quantity1",$getProduct["sold_quantity"]);
				$value1a = $getProduct["sold_quantity"] - $value["quantity"];
				 //$value1a_1=$value["id"];
				//var_dump("quantity",$value["quantity"]);

				$newSales =ModelProduct:: mdlActivateProduct($tableProduct, $item1a, $value1a, $valueProductId);
				

			 	$item1b="stock";
			 	$value1b=$value["quantity"]+$getProduct["stock"];
			 	$newStock=ModelProduct:: mdlActivateProduct($tableProduct,$item1b,$value1b,$valueProductId);
			 	


			
			}

			$tableCustomer = "client";

			$item="id";
			$valueCustomer = $_POST["selectCustomer"];
			$getCustomer = ModelClient::mdlShowCLient($tableCustomer, $item, $valueCustomer);

			 $item1a = "total_purchase";
			 $value1a =$getCustomer["total_purchase"]- array_sum($totalPurchasedProducts) ;

			 $customerPurchases = ModelClient::mdlActivateClient($tableCustomer, $item1a, $value1a, $valueCustomer);

			// update sale tabel

			$listproduct_2=json_decode($productsList,true);

			$totalPurchasedProducts_2 = array();

			foreach ($listproduct_2 as $key => $value) {

			array_push($totalPurchasedProducts_2,$value["quantity"]);

				$tableProduct_2="product";
				$item_2="id";
				$valueProductId_2=$value["id"];
				$getProduct_2 = ModelProduct::mdlShowProduct($tableProduct_2, $item_2, $valueProductId_2);

				

				$item1a_2="sold_quantity";
				$value1a_2=$value["quantity"]+$getProduct_2["sold_quantity"];
				//$value1a_1_2=$value["id"];
				$newSale_2=ModelProduct:: mdlActivateProduct($tableProduct_2,$item1a_2,$value1a_2,$valueProductId_2);
			

				$item1b_2="stock";
				$value1b_2=$value["stock"];
				$newStock_2=ModelProduct:: mdlActivateProduct($tableProduct_2,$item1b_2,$value1b_2,$valueProductId_2);
			

		 	}

			$tableCustomer_2 = "client";

			$item_2="id";
			$valueCustomer_2 = $_POST["selectCustomer"];
			$getCustomer_2 = ModelClient::mdlShowCLient($tableCustomer_2, $item_2, $valueCustomer_2);
			$item1a_2 = "total_purchase";
			$value1a_2 = array_sum($totalPurchasedProducts_2) + $getCustomer_2["total_purchase"];

			$customerPurchases_2 = ModelClient::mdlActivateClient($tableCustomer_2, $item1a_2, $value1a_2, $valueCustomer_2);

			$item1b_2 = "last_purchase";

			date_default_timezone_set('Asia/Yangon');

			$date_2 = date('Y-m-d');
			$hour_2 = date('H:i:s');
			$value1b_2 = $date_2.' '.$hour_2;

			$dateCustomer_2 = ModelClient::mdlActivateClient($tableCustomer_2, $item1b_2, $value1b_2, $valueCustomer_2);
		}

			$table="sale";
			$data = array("id_seller"=>$_POST["idSeller"],
						   "id_client"=>$_POST["selectCustomer"],
						   "code"=>$_POST["editSale"],
						   "product"=>$productsList,
						   "tax"=>$_POST["newTaxPrice"],
						   "net_price"=>$_POST["newNetPrice"],
						   "total"=>$_POST["saleTotal"],
						   "payment_method"=>$_POST["listPaymentMethod"]);

			$answer = ModelSale::mdlEditSale($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "The sale has been edited added",
					  showConfirmButton: true,
					  confirmButtonText: "OK"
					  }).then((result) => {
								if (result.value) {

								window.location = "manage-sale";

								}
							})

				</script>';

			}





	 }

	 }

	static public function ctrDeleteSale(){

		if(isset($_GET["idSale"])){
			$table="sale";
			$item="id";
			$value=$_GET["idSale"];

			$deleteSale=ModelSale::mdlShowSale($table,$item,$value);
			//var_dump($deleteSale["id"]);

			$itemSale=null;
			$valueSale=null;
			$getSale=ModelSale::mdlShowSale($table,$itemSale,$valueSale);
			$arrayDate=array();

			foreach($getSale as $key=>$value){
				if($value["id_client"] == $deleteSale["id_client"]){
					array_push($arrayDate,$value["date"]);
				}
			}

			//var_dump($arrayDate);

			if(count($arrayDate)>1){
				//var_dump("hello");
				if($deleteSale["date"]>$arrayDate[count($arrayDate)-2]){
				//var_dump("hello2");
				$item2="last_purchase";
				$tableCustomer2="client";
				$value2=$arrayDate[count($arrayDate)-2];
				//var_dump($arrayDate[count($arrayDate)-2]);
				$valueIdClient=$deleteSale["id_client"];
				$updateClient1= ModelClient::mdlActivateClient($tableCustomer2, $item2, $value2, $valueIdClient);

				}

			}else{
				//var_dump("Hello2");
				$item1="last_purchase";
				$value1="0000-00-00 00:00:00";
				$tableCustomer="client";
				$valueCustomer=$deleteSale["id_client"];
				//var_dump($valueCustomer);
				$updateClient= ModelClient::mdlActivateClient($tableCustomer, $item1, $value1, $valueCustomer);
			}


			$listproduct=json_decode($deleteSale["product"],true);

			$totalPurchasedProducts = array();

			//var_dump("tttttttttt",$listproduct);

			foreach ($listproduct as $key => $value){
				
				array_push($totalPurchasedProducts,$value["quantity"]);

			 	$tableProduct="product";
				$item="id";
			 	$valueProductId=$value["id"];
			 	$getProduct = ModelProduct::mdlShowProduct($tableProduct, $item, $valueProductId);


			 	$item1a = "sold_quantity";
				$value1a = $getProduct["sold_quantity"] - $value["quantity"];

				$newSales =ModelProduct:: mdlActivateProduct($tableProduct, $item1a, $value1a, $valueProductId);
				

			 	$item1b="stock";
			 	$value1b=$value["quantity"]+$getProduct["stock"];
			 	$newStock=ModelProduct:: mdlActivateProduct($tableProduct,$item1b,$value1b,$valueProductId);
			 	


			
			}

			$tableCustomer = "client";

			$item="id";
			$valueCustomer = $deleteSale["id_client"];
			$getCustomer = ModelClient::mdlShowCLient($tableCustomer, $item, $valueCustomer);

			 $item1a = "total_purchase";
			 $value1a =$getCustomer["total_purchase"]- array_sum($totalPurchasedProducts) ;

			 $customerPurchases = ModelClient::mdlActivateClient($tableCustomer, $item1a, $value1a, $valueCustomer);


			 $answer=ModelSale::mdlDeleteSale($table,$_GET["idSale"]);

			 	if($answer == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "The sale has been deleted succesfully",
					  showConfirmButton: true,
					  confirmButtonText: "Close",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "manage-sale";

								}
							})

				</script>';

			}

			


		}

	}
	}
