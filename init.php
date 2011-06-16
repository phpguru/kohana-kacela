<?php
/** 
 * @author noah
 * @date 3/23/11
 * @brief
 * 
 */

$config = Kohana::config('kacela');

$kacela = Kacela::instance();

Gacela\DataSource\Adapter\Mysql::$_separator = '-';

foreach($config['namespaces'] as $ns => $path)
{
	$kacela->register_namespace($ns, $path);
}

foreach($config['datasources'] as $name => $source)
{
	$kacela->register_datasource($name, $source['type'], $source);
}

if($config['cache'])
{
	$kacela->enable_cache(Cache::instance());
}