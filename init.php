<?php
/** 
 * @author noah
 * @date 3/23/11
 * @brief
 * 
 */


$config = Kohana::config('gacela');

$kacela = Kacela::instance();

$kacela->registerNamespace('Lendio', APPPATH.'classes/')
		->registerDataSource('db', 'database', $config['optimus']);

Gacela\DataSource\Resource\Database::setSeparator('-');