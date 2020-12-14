<?php

	class Connection{
		static public function Connector(){
			$link=new PDO("mysql:host=localhost;dbname=pos",
				"root","");
			$link->exec("set names utf8");
			return $link;
		}
	}