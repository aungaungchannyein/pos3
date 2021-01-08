<?php

	require_once "../controller/product.controller.php";
	require_once "../model/product.model.php";

class TableSaleProduct{
	public function showSaleProductTable(){

		$item=null;
        $value=null;
        $order="id";
		$product=ProductController::ctrShowProduct($item,$value,$order);
		
		$dataJson='{
  				"data": [';

  for($i=0; $i<count($product); $i++){
  	if($product[$i]["photo"]!=null){
  			$image="<img src='".$product[$i]["photo"]."' width='40px'>";
	}else{
    $image="<img src='view/img/products/default/anonymous.png' width='40px'>";

  }
  	

  	if($product[$i]["stock"] <=10){
  		$stock="<button class='btn btn-danger'>".$product[$i]["stock"]."</button>";
  	}elseif($product[$i]["stock"]>11 && $product[$i]["stock"]<=15){
  		$stock="<button class='btn btn-warning'>".$product[$i]["stock"]."</button>";
  	}else{
  		$stock="<button class='btn btn-success'>".$product[$i]["stock"]."</button>";
  	}
  	

  	$button="<div class='btn-group'><button class='btn btn-primary addProduct recallerButton' idProduct='".$product[$i]["id"]."' >Add</button></div>";

  	$dataJson.='
    [
      "'.($i+1).'",
      "'.$image.'",
      "'.$product[$i]["code"].'",
      "'.$product[$i]["description"].'",
      "'.$stock.'",
      "'.$button.'"
    ],';

  }

  $dataJson=substr($dataJson,0,-1);

  $dataJson.=']
}';

  echo $dataJson;


	}
}

$activeTable=new TableSaleProduct();
$activeTable->showSaleProductTable();