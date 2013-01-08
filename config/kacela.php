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
		/**
		 *
		 */
		'sf' => array
		(
			'type' => 'salesforce',
			/**
			 * Kacela uses the Force.com toolkit for PHP.
			 * It can be found here: https://github.com/developerforce/Force.com-Toolkit-for-PHP
			 * Once installed in your application, Kacela needs to know the path to the soap client.
			 */
			'soapclient_path' => MODPATH.'sf/vendor/soapclient/',
			/**
			 * Specify the full path to your wsdl file for Salesforce
			 */
			'wsdl_path' => APPPATH.'config/sf.wsdl',
			'username' => 'salesforceuser@domain.com.sandbox',
			'password' => 'SecretPasswordWithSalesforceHash',
			/**
			 * Specifies which Salesforce objects are available for use in Kacela
			 */
			'objects' => array()
		)
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
