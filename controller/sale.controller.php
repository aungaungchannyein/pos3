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

			// date_default_timezone_set('America/Bogota');

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

			$item = "id";
			$value = $_GET["editSale"];

			$getSale = ModelSale::mdlShowSale($table, $item, $value);

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

			// date_default_timezone_set('America/Bogota');

			$date = date('Y-m-d');
			$hour = date('H:i:s');
			$value1b = $date.' '.$hour;

			$dateCustomer = ModelClient::mdlActivateClient($tableCustomer, $item1b, $value1b, $valueCustomer);

			$table="sale";
			$data = array("id_seller"=>$_POST["idSeller"],
						   "id_client"=>$_POST["selectCustomer"],
						   "code"=>$_POST["editSale"],
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
	}
