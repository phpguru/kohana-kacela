<?php
/** 
 * @author noah
 * @date 3/26/11
 * @brief
 * 
*/

require MODPATH.'/gacela/vendor/Gacela/library/Gacela.php';

class Kacela extends Gacela {

	/**
	 * @static
	 * @param  $mapper
	 * @return Mapper\Mapper
	 */
	public static function load($mapper)
	{
		return self::instance()->loadMapper(ucfirst($mapper));
	}

	public static function find($mapper, $id = null)
	{
		return self::load(ucfirst($mapper))->find($id);
	}

	public static function find_all($mapper, Gacela\Criteria $criteria = null)
	{
		return self::load(ucfirst($mapper))->findAll($criteria);
	}

	public static function criteria()
	{
		$criteria = self::instance()->autoload('\\Criteria');
		return new $criteria();
	}
}
