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
		'Kacela' => MODPATH.'kacela/classes/kacela/',
		'App' => APPPATH.'classes/'
	),
	'datasources' => array
	(
		'db' => array
		(
			'type' => 'database',
			'dbtype' => 'mysql',
			'schema' => 'kacela',
			'host' => 'localhost',
			'user' => 'root',
			'password' => ''
		)
	),
	'cache_schema' => false,
	'cache_data' => false
);
