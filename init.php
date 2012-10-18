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

foreach($config['datasources'] as $name => $source)
{
	$kacela->register_datasource($name, $source['type'], $source);
}

if(isset($config['cache_schema']) OR isset($config['cache_data']))
{
	$kacela->enable_cache(Cache::instance(), \Arr::get($config, 'cache_schema', true), \Arr::get($config, 'cache_data', false));
}