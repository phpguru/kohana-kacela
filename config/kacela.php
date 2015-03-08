<?php
/**
 * @author noahg
 * @date 6/16/11
 * @brief
 *
 */
 defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */

return array
(
	/**
	 * List of data sources and connection params
	 */
	'datasources' => array
	(
		/**
		 * db is the default data source for Mappers
		 * PDO is the
		 */
		'db' => array
		(
			/**
			 * Valid types are: mysql (More will be added soon)
			 */
			'type' => 'mysql',
			/**
			 * Database name
			 */
			'schema' => 'kacela',
			/**
			 * Connection host
			 */
			'host' => 'localhost',
			/**
			 * Database username
			 */
			'user' => 'root',
			/**
			 * Database password
			 */
			'password' => ''
		),
	),
	/**
	 * Can specify TRUE to use default Cache::instance() otherwise, specify Cache group name
	 */
	'cache' => false,
	/**
	 * Set to TRUE causes the Kohana_Profiler to run for Kacela
	 */
	'profiling' => false
);
