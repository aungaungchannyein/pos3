<?php

class SaleController{
	static public function ctrShowSale($item,$value){
		$table="sale";
		$answer=ModelSale::mdlShowSale($table,$item,$value);
		return $answer;
	}
	}
