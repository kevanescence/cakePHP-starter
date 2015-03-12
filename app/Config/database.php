<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'cakePHP',
		'password' => 'cakePHP',
		'database' => 'cakePHP-starter',
		'prefix' => '',
		'encoding' => 'utf8'
	);

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'cakePHP',
		'password' => 'cakePHP',
		'database' => 'cakePHP-starter_test',
		'prefix' => '',
		'encoding' => 'utf8'
	);
}
