<?php

class ProductController{

	static public function ctrShowProduct($item,$value){
		
		$table="product";
		$answer=ModelProduct::mdlShowProduct($table,$item,$value);
		return $answer;

	}
}
