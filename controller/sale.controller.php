<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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
				$order="id";
				$getProduct = ModelProduct::mdlShowProduct($tableProduct, $item, $valueProductId,$order);

				

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


				 //$printer = "epson20";

				 //$connector = new WindowsPrintConnector($printer);

				 //$printer = new Printer($connector);

				// $printer -> setJustification(Printer::JUSTIFY_CENTER);

				// $printer -> text(date("Y-m-d H:i:s")."\n");//Invoice date

				// $printer -> feed(1); //We feed paper 1 time*/

				// $printer -> text("Inventory System"."\n");//Company name

				// $printer -> text("ID: 71.759.963-9"."\n");//Company's ID

				// $printer -> text("Address: 5th Ave. Miami Fl"."\n");//Company address

				// $printer -> text("Phone: 092056316"."\n");//Company's phone

				// $printer -> text("Invoice N.".$_POST["newSale"]."\n");//Invoice number

				// $printer -> feed(1); //We feed paper 1 time*/

				// $printer -> text("Customer: ".$getCustomer["name"]."\n");//Customer's name

				// $tableSeller = "user";
				// $item = "id";
				// $seller = $_POST["idSeller"];

				// $getSeller = UsersModel::MdlShowUsers($tableSeller, $item, $seller);

				// $printer -> text("Seller: ".$getSeller["name"]."\n");//Seller's name

				// $printer -> feed(1); //We feed paper 1 time*/

				// foreach ($productsList as $key => $value) {

				// 	$printer->setJustification(Printer::JUSTIFY_LEFT);

				// 	$printer->text($value["description"]."\n");//Product's name

				// 	$printer->setJustification(Printer::JUSTIFY_RIGHT);

				// 	$printer->text("$ ".number_format($value["price"],2)." Und x ".$value["quantity"]." = $ ".number_format($value["totalPrice"],2)."\n");

				// }

				// $printer -> feed(1); //We feed paper 1 time*/			
				
				// $printer->text("NET: $ ".number_format($_POST["newNetPrice"],2)."\n"); //net price

				// $printer->text("TAX: $ ".number_format($_POST["newTaxPrice"],2)."\n"); //tax value

				// $printer->text("--------\n");

				// $printer->text("TOTAL: $ ".number_format($_POST["saleTotal"],2)."\n"); //ahora va el total

				// $printer -> feed(1); //We feed paper 1 time*/	

				// $printer->text("Thanks for your purchase"); //We can add a footer

				// $printer -> feed(3); //We feed paper 3 times*/

				// $printer -> cut(); //We cut the paper, if the printer has the option

				// $printer -> pulse(); //Through the printer we send a pulse to open the cash drawer.

				// $printer -> close(); 

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
			 	$order="id";
			 	$getProduct = ModelProduct::mdlShowProduct($tableProduct, $item, $valueProductId,$order);


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
				$order="id";
				$getProduct_2 = ModelProduct::mdlShowProduct($tableProduct_2, $item_2, $valueProductId_2,$order);

				

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
					array_push($arrayDate,$value["saledate"]);
				}
			}

			//var_dump($arrayDate);

			if(count($arrayDate)>1){
				//var_dump("hello");
				if($deleteSale["saledate"]>$arrayDate[count($arrayDate)-2]){
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
			 	$order ="id";
			 	$getProduct = ModelProduct::mdlShowProduct($tableProduct, $item, $valueProductId,$order);


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

	static public function ctrSalesDatesRange($initialDate, $finalDate){

		$table = "sale";

		$answer = ModelSale::mdlSalesDatesRange($table, $initialDate, $finalDate);

		return $answer;
		
	}

	static public function ctrDownloadReport(){

		if(isset($_GET["report"])){

			$table = "sale";

			if(isset($_GET["initialDate"]) && isset($_GET["finalDate"])){

				$sales = ModelSale::mdlSalesDatesRange($table, $_GET["initialDate"], $_GET["finalDate"]);

			}else{

				$item = null;
				$value = null;

				$sales = ModelSale::mdlShowSale($table, $item, $value);

			}

			/*=============================================
			WE CREATE EXCEL FILE
			=============================================*/

			$name = $_GET["report"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Excel file
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>Code</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>customer</td>
					<td style='font-weight:bold; border:1px solid #eee;'>User</td>
					<td style='font-weight:bold; border:1px solid #eee;'>quantity</td>
					<td style='font-weight:bold; border:1px solid #eee;'>products</td>
					<td style='font-weight:bold; border:1px solid #eee;'>tax</td>
					<td style='font-weight:bold; border:1px solid #eee;'>netPrice</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($sales as $row => $item){

				$customer = ClientController::ctrShowClient("id", $item["id_client"]);
				$user = UserController::ctrShowUser("id", $item["id_seller"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["code"]."</td> 
			 			<td style='border:1px solid #eee;'>".$customer["name"]."</td>
			 			<td style='border:1px solid #eee;'>".$user["name"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$products =  json_decode($item["product"], true);

			 	foreach ($products as $key => $valueproducts) {
			 			
			 			echo utf8_decode($valueproducts["quantity"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($products as $key => $valueproducts) {
			 			
		 			echo utf8_decode($valueproducts["description"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["tax"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["net_price"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["payment_method"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["saledate"],0,10)."</td>		
		 			</tr>");

			}


			echo "</table>";

		}
		
	}

	public function ctrAddingTotalSales(){

		$table = "sale";

		$answer = ModelSale::mdlAddingTotalSales($table);

		return $answer;

	}
	}
