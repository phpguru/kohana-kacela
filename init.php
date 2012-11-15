<?php
/**
 * @author noah
 * @date 3/23/11
 * @brief
 *
 */

$config = Kohana::$config->load('kacela');

$kacela = Kacela::instance();

Kacela_DataSource_Adapter_Mysql::$_separator = '-';

if(is_dir(APPPATH . 'config/kacela'))
{
	$kacela->configPath(APPPATH . 'config/kacela');
}

foreach($config->get('datasources') as $name => $source)
{
	$source['name'] = $name;

	$source = Kacela::createDataSource($source);

	$kacela->register_datasource($source);
}

if(($cache = $config->get('cache')) !== false)
{
	if(is_bool($cache))
	{
		$cache = null;
	}

	$kacela->enable_cache(Cache::instance($cache));
}