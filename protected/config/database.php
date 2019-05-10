<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	'connectionString' => 'pgsql:host=ec2-54-221-198-156.compute-1.amazonaws.com;port=5432;dbname=dalihpfosvhisi',
	'emulatePrepare' => true,
	'username' => 'djzerfymxmzvbk',
	'password' => '48c7c0f9940b6e224a965d95c9a29923b224df305e2c849145232d6eec938d2a',
	'charset' => 'utf8',
);