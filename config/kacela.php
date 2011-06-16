<?php
/** 
 * @author noahg
 * @date 6/16/11
 * @brief
 * 
 */
 defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'namespaces' => array
	(
		'App' => APPPATH.'/classes',
		'kacela' => MODPATH.'/classes/'
	),
	'datasources' => array
	(
		'db' => array
		(
			'type' => 'database',
			'dbtype' => 'mysql',
			'schema' => 'gacela',
			'host' => 'localhost',
			'user' => 'root',
			'password' => ''
		)
	),
	'cache' => false
);
