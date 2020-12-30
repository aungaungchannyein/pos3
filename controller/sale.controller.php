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

			var_dump($listproduct);

		}

	}
	}
