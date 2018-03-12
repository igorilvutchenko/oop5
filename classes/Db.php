<?php

class Db {

	static public $instance = false;

	static public function connect()
	{
		if(!self::$instance)
			self::$instance = new mysqli('localhost', 'root', '', 'alpha');
	}

	static public function disconnect()
	{
		if(self::$instance)
			self::$instance->close();
	}

}