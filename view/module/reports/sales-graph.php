<?php

error_reporting(0);
//var_dump("erteriu",$_POST["initialDate"]);
	if(isset($_GET["initialDate"])){

		 if(isset($_GET["initialDate"])){

            $initialDate = $_GET["initialDate"];
            $finalDate = $_GET["finalDate"];

          }else{

            $initialDate = null;
            $finalDate = null;

          }

          //var_dump($initialDate);

          $answer = SaleController::ctrSalesDatesRange($initialDate, $finalDate);

          $arrayDates = array();
          $arraySales = array();
          $addingMonthPayments = array();

          foreach ($answer as $key => $value) {
          	//var_dump($value["saledate"]);
          	$singleDate = substr($value["saledate"],0,10);
          	//var_dump($singleDate);

          	array_push($arrayDates, $singleDate);

          	$arraySales = array($singleDate => $value["total"]);
          	//var_dump($arraySales);

          	foreach ($arraySales as $key => $value) {
		
				$addingMonthPayments[$key] += $value;
			}
          	# code...
          }

         //var_dump($answer);
         //var_dump($addingMonthPayments);
          $noRepeatDates = array_unique($arrayDates);
	}
 ?>

 <div class="box box-solid bg-teal-gradient">
 	<div class="box-header">
 		<i class="fa fa-th"></i>
 		<h3 class="box-title">Sales Graph</h3>
 	</div>

 	<div class="box-body border-radius-none newSalesGraph">

		<div class="chart" id="line-chart-Sales" style="height: 250px;"></div>

    </div>
 </div>

 <script>

 	var line = new Morris.Line({
    element          : 'line-chart-Sales',
    resize           : true,
    data             : [

    <?php

    if($noRepeatDates != null){

	    foreach($noRepeatDates as $key){

	    	echo "{ y: '".$key."', Sales: ".$addingMonthPayments[$key]." },";


	    }

	    echo "{y: '".$key."', Sales: ".$addingMonthPayments[$key]." }";

    }else{

       echo "{ y: '0', Sales: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['Sales'],
    labels           : ['Sales'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10
  });


 	

 </script>