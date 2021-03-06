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

    <table>
        
        <tr>
            
            <td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

            <td style="background-color:white; width:140px">
                
                <div style="font-size:8.5px; text-align:right; line-height:15px;">
                    
                    

                    <br>
                    ADDRESS: Shwebo

                </div>

            </td>

            <td style="background-color:white; width:140px">

                <div style="font-size:8.5px; text-align:right; line-height:15px;">
                    
                    <br>
                    CELLPHONE: 09 205 6316
                    
                    <br>
                    aungaung.channyein@gmail.com

                </div>
                
            </td>

            <td style="background-color:white; width:110px; text-align:center; color:red"><br><br>BILL N.<br>$valueSale</td>

        </tr>

    </table>

EOF;

$mpdf->writeHTML($block1);

// ---------------------------------------------------------

$block2 = <<<EOF

    <table>
        
        <tr>
            
            <td style="width:540px"><img src="images/back.jpg"></td>
        
        </tr>

    </table>

    <table style="font-size:10px; padding:5px 10px;">
    
        <tr>
        
            <td style="border: 1px solid #666; background-color:white; width:390px">

                Customer: $answerCustomer[name]

            </td>

            <td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
            
                Date: $saledate

            </td>

        </tr>

        <tr>
        
            <td style="border: 1px solid #666; background-color:white; width:540px">
            Seller: $answerSeller[name]

            </td>

        </tr>

        <tr>
        
        <td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

        </tr>

    </table>

EOF;

$mpdf->writeHTML($block2);

// ---------------------------------------------------------

$block3 = <<<EOF

    <table style="font-size:10px; padding:5px 10px;">

        <tr>
        
        <td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Product</td>
        <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">quantity</td>
        <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">value Unit.</td>
        <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">value Total</td>

        </tr>

    </table>

EOF;

$mpdf->writeHTML($block3);

// ---------------------------------------------------------

foreach ($products as $key => $item) {

$itemProduct = "description";
$valueProduct = $item["description"];
$order="id";

$answerProduct = ProductController::ctrShowProduct($itemProduct, $valueProduct,$order);
//var_dump($answerProduct);

$valueUnit = number_format($answerProduct["selling_price"], 2);

$totalPrice = number_format($item["totalPrice"], 2);

$block4 = <<<EOF

    <table style="font-size:10px; padding:5px 10px;">

        <tr>
            
            <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">$item[description]</td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                $item[quantity]
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                $valueUnit
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                $totalPrice
            </td>


        </tr>

    </table>


EOF;

$mpdf->writeHTML($block4);

}

// ---------------------------------------------------------

$block5 = <<<EOF

    <table style="font-size:10px; padding:5px 10px;">

        <tr>

            <td style="color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

            <td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

        </tr>
        
        <tr>
        
            <td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
                Net:
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                $ $netPrice
            </td>

        </tr>

        <tr>

            <td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
                Tax:
            </td>
        
            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                $ $tax
            </td>

        </tr>

        <tr>
        
            <td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
                Total:
            </td>
            
            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                $ $totalPrice
            </td>

        </tr>


    </table>

EOF;

$mpdf->writeHTML($block5);

$mpdf->Output();

}

}

$bill = new printBill();
$bill -> code = $_GET["code"];
$bill -> getBillPrinting();

?>