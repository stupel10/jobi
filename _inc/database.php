<?php

use Medoo\Medoo;
// conect to db
$database = new medoo([
	'database_type' => 'mysql',
	'database_name' => 'jobi',
	'server'        => 'localhost',
	'username'      => 'root',
	'password'      => 'root'
]);