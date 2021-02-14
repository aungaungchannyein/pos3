<?php

require_once __DIR__ . '/vendor/autoload.php';


require_once "../controller/sale.controller.php";
require_once "../model/sale.model.php";

require_once "../controller/client.controller.php";
require_once "../model/client.model.php";

require_once "../controller/user.controller.php";
require_once "../model/user.model.php";

require_once "../controller/product.controller.php";
require_once "../model/product.model.php";

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
$totalPrices = number_format($answerSale["total"],2);
$notpaid= $answerSale["payment_method"];

//TRAEMOS LA INFORMACIÓN DEL Customer

$itemCustomer = "id";
$valueCustomer = $answerSale["id_client"];

$answerCustomer = ClientController::ctrShowClient($itemCustomer, $valueCustomer);

//TRAEMOS LA INFORMACIÓN DEL Seller

$itemSeller = "id";
$valueSeller = $answerSale["id_seller"];

$answerSeller = UserController::ctrShowUser($itemSeller, $valueSeller);

$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf(
    [
        'tempDir' => __DIR__ . '/upload',
        'format' => [74, 105],
        'margin_left' => 5 ,
		'margin_right' => 0,
		'margin_header' => 0,
		'margin_footer' => 0,
		'default_font_size' => 50,
        'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/fonts'
        ]),
        'fontdata' => $fontData + [
            'pydoungsu' => [
                'R' => 'Pyidaungsu-2.5_Regular.ttf',
                'useOTL' => 0xFF,
            ],
        ],
        'default_font' => 'pydoungsu'
        
    ]
);

//$mpdf->AddPage('L');
//$mpdf ->AddPage('P', 'A7');
//---------------------------------------------------------

$block1 = <<<EOF

<table style="font-size:13px; text-align:center" align="center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
				Date: $saledate

				
				<p style="font-size:16px">Aung Kyaw Oo (တောင်းဖျာနှီးကုန်)</p>
				
				

				<br>
				Address: Shwebo

				<br>
				Phone: 092056316

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

$mpdf->writeHTML($block1);

// ---------------------------------------------------------
$blockheader= <<<EOF

<table style="font-size:13px;" border="0" >

	<tr>

		<td style="width:10px;">
		No. 
		</td>

	
		<td style="width:82px; text-align:center">
		Description 
		</td>

	
	
		<td style="width:60px; text-align:center">
		unit
		<br>
		</td>

		<td style="width:20px; text-align:center">
		qty
		<br>
		</td>
		<td style="width:70px; text-align:center">
		totalPrice
		<br>
		</td>

	</tr>

</table>



EOF;

$mpdf->writeHTML($blockheader);


foreach ($products as $key => $item) {

$key+=1;

$unitValue = number_format($item["price"], 2);

$totalPrice = number_format($item["totalPrice"], 2);

$block2 = <<<EOF

<table style="font-size:13px;" border="0">

	<tr>

		<td style="width:20px; text-align:right">
		$key
		</td>
	
		<td style="width:80px; text-align:left">
		$item[description] 
		</td>

	
	
		<td style="width:60px; text-align:right">
		$unitValue
		<br>
		</td>

		<td style="width:20px; text-align:right">
		$item[quantity]
		<br>
		</td>
		<td style="width:70px; text-align:right">
		$totalPrice
		<br>
		</td>

	</tr>

</table>

EOF;

$mpdf->writeHTML($block2);

}

// ---------------------------------------------------------


$block3 = <<<EOF

<table style="font-size:13px; text-align:right">

	<tr>
	
		<td style="width:180px;">
			 NET: 
		</td>

		<td style="width:70px;">
			$ $netPrice
		</td>

	</tr>

	<tr>
	
		<td style="width:180px;">
			 TAX: 
		</td>

		<td style="width:70px;">
			$ $tax
		</td>

	</tr>

	<tr>

		<td>
			
		</td>
	
		<td style="width:70px;">
			 ---------
		</td>

	</tr>

	<tr>
	
		<td style="width:180px;">
			 TOTAL: 
		</td>

		<td style="width:70px;">
			$ $totalPrices
		</td>

	</tr>

	<tr>
	
		<td style="width:70px;">
			<br>
			<br>
			<span style="text-align:center;">Thank you for your purchase</span>
		</td>

	</tr>

</table>



EOF;

$mpdf->writeHTML($block3);

if ($notpaid == "မရှင်းသေး"){

$block4 = <<<EOF

<table style="font-size:13px; text-align:center;">

	

	<tr>
	
		<td >
			<span style="text-align:center;"><h1>****မရှင်းသေး*****</h1></span>
		</td>

	</tr>

</table>



EOF;

$mpdf->writeHTML($block4);
}
else{
$block4 = <<<EOF

<table style="font-size:13px; text-align:center;">

	<tr>
	
		<td >
			<span style="text-align:center;"><h1>****ရှင်းပြီး*****</h1></span>
		</td>

	</tr>

</table>



EOF;

$mpdf->writeHTML($block4);

}
$mpdf->Output();

}

}

$bill = new printBill();
$bill -> code = $_GET["code"];
$bill -> getBillPrinting();

?>