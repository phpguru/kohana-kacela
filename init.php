<?php
/** 
 * @author noah
 * @date 3/23/11
 * @brief
 * 
 */


Gacela\DataSource\Adapter\Mysql::$_separator = '-';

$config = Kohana::config('kacela');

$kacela = Kacela::instance();

foreach($config['namespace'] as $ns => $path)
{
	$kacela->register_namespace($ns, $path);
}

foreach($config['datasource'] as $name => $source)
{
	$kacela->register_datasource($name, $source['type'], $source);
}

if($config['cache'])
{
	$kacela->enable_cache(Cache::instance());
}