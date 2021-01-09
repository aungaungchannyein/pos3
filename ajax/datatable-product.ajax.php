<?php

	require_once "../controller/category.controller.php";
	require_once "../controller/product.controller.php";

	require_once "../model/category.model.php";
	require_once "../model/product.model.php";

class TableProduct{
	public function showProductTable(){

		$item=null;
        $value=null;
        $order ="id";
		$product=ProductController::ctrShowProduct($item,$value,$order);
		

		
		

		
		$dataJson='{
  				"data": [';

  for($i=0; $i<count($product); $i++){
  	if($product[$i]["photo"]!=null){
  			$image="<img src='".$product[$i]["photo"]."' width='40px'>";
	}else{
    $image="<img src='view/img/products/default/anonymous.png' width='40px'>";

  }
  	

  	$item="id";
  	$value=$product[$i]["id_category"];
  	$category=CategoryController::ctrShowCategory($item,$value);
  	if($product[$i]["stock"] <=10){
  		$stock="<button class='btn btn-danger'>".$product[$i]["stock"]."</button>";
  	}elseif($product[$i]["stock"]>11 && $product[$i]["stock"]<=15){
  		$stock="<button class='btn btn-warning'>".$product[$i]["stock"]."</button>";
  	}else{
  		$stock="<button class='btn btn-success'>".$product[$i]["stock"]."</button>";
  	}


    if(isset($_GET["hiddenProfile"]) && $_GET["hiddenProfile"] == "special") 
      {
    $button =  "<div class='btn-group'><button class='btn btn-warning btnEditProduct' idProduct='".$product[$i]["id"]."' data-toggle='modal' data-target='#modalEditProduct'><i class='fa fa-pencil'></i></button></div>";
      }else{
  	$button="<div class='btn-group'><button class='btn btn-warning btnEditProduct' idProduct='".$product[$i]["id"]."' data-toggle='modal' data-target='#modalEditProduct'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnDeleteProduct' productId='".$product[$i]["id"]."' productPhoto='".$product[$i]["photo"]."' productCode='".$product[$i]["code"]."'><i class='fa fa-times'></i></button></div>";}

  	$dataJson.='
    [
      "'.($i+1).'",
      "'.$image.'",
      "'.$product[$i]["code"].'",
      "'.$product[$i]["description"].'",
      "'.$category["category"].'",
      "'.$stock.'",
      "'.$product[$i]["selling_price"].'",
      "'.$product[$i]["buying_price"].'",
      "'.$product[$i]["date"].'",
      "'.$button.'"
    ],';

  }

  $dataJson=substr($dataJson,0,-1);

  $dataJson.=']
}';

  echo $dataJson;


	}
}

$activeTable=new TableProduct();
$activeTable->showProductTable();