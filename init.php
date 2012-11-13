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

foreach($config['datasources'] as $name => $config)
{
	$config['name'] = $name;

	$source = Kacela::createDataSource($config);

	$kacela->register_datasource($source);
}

if(isset($config['cache']))
{
	if(is_bool($config['cache']))
	{
		$config['cache'] = null;
	}

	$kacela->enable_cache(Cache::instance($config['cache']));
}