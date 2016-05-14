<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database

	'connectionString' => 'pgsql:host=localhost;port=5432;dbname=csapotosi_db',
	'emulatePrepare' => true,
	'username' => 'postgres',
	'password' => 'root',
	'charset' => 'utf8',
);