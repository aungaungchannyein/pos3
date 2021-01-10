<?php

require_once "../../../controller/sale.controller.php";
require_once "../../../model/sale.model.php";

require_once "../../../controller/client.controller.php";
require_once "../../../model/client.model.php";

require_once "../../../controller/user.controller.php";
require_once "../../../model/user.model.php";

require_once "../../../controller/product.controller.php";
require_once "../../../model/product.model.php";

class printBill{

public $code;

public function getBillPrinting(){

//WE BRING THE INFORMATION OF THE SALE

$itemSale = "code";
$valueSale = $this->code;

$answerSale = SaleController::ctrShowSale($itemSale, $valueSale);

$saledate = substr($answerSale["saledate"],0,-8);
$products = json_decode($answerSale["product"], true);
$netPrice = number_format($answerSale["net_price"],2);
$tax = number_format($answerSale["tax"],2);
$totalPrice = number_format($answerSale["total"],2);

//TRAEMOS LA INFORMACIÓN DEL Customer

$itemCustomer = "id";
$valueCustomer = $answerSale["id_client"];

$answerCustomer = ClientController::ctrShowClient($itemCustomer, $valueCustomer);

//TRAEMOS LA INFORMACIÓN DEL Seller

$itemSeller = "id";
$valueSeller = $answerSale["id_seller"];

$answerSeller = UserController::ctrShowUser($itemSeller, $valueSeller);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');
$fontname = TCPDF_FONTS::addTTFfont('../fonts/Pyidaungsu-2.5.1_Regular.ttf', 'TrueTypeUnicode', '', 32);
$pdf->SetFont($fontname, '', 14, true);

//---------------------------------------------------------

$block1 = <<<EOF

<table style="font-size:9px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
				Date: $saledate

				<br><br>
				Inventory System
				
				<br>
				NIT: 71.759.963-9

				<br>
				Address: 5th Ave. Miami, Fl

				<br>
				Phone: 300 786 52 49

				<br>
				Invoice N.$valueSale

				<br><br>					
				Customer: $answerCustomer[name]

				<br>
				Seller: $answerSeller[name]

				<br>

			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($block1, false, false, false, false, '');

// ---------------------------------------------------------


foreach ($products as $key => $item) {

$unitValue = number_format($item["price"], 2);

$totalPrice = number_format($item["totalPrice"], 2);

$block2 = <<<EOF

<table style="font-size:9px;" border="1">

	<tr>
	
		<td style="width:40px; text-align:left">
		$item[description] 
		</td>

	
	
		<td style="width:40px; text-align:right">
		$ $unitValue
		<br>
		</td>

		<td style="width:40px; text-align:right">
		$item[quantity]
		<br>
		</td>
		<td style="width:40px; text-align:right">
		$ $totalPrice
		<br>
		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($block2, false, false, false, false, '');

}

// ---------------------------------------------------------

$block3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:80px;">
			 NET: 
		</td>

		<td style="width:80px;">
			$ $netPrice
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 TAX: 
		</td>

		<td style="width:80px;">
			$ $tax
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 TOTAL: 
		</td>

		<td style="width:80px;">
			$ $totalPrice
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			<br>
			<br>
			Thank you for your purchase
		</td>

	</tr>

</table>



EOF;

$pdf->writeHTML($block3, false, false, false, false, '');


// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

// $pdf->Output('bill.pdf', 'D');

$pdf->Output('bill.pdf','I');

}

}

$bill = new printBill();
$bill -> code = $_GET["code"];
$bill -> getBillPrinting();

?>