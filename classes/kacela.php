<?php
/** 
 * @author noah
 * @date 3/26/11
 * @brief
 * 
*/

require MODPATH.'/kacela/vendor/Gacela/library/Gacela.php';

class Kacela extends Gacela
{

	/**
	 * @static
	 * @param  $mapper
	 * @return Mapper\Mapper
	 */
	public static function load($mapper)
	{
		return self::instance()->loadMapper(ucfirst($mapper));
	}

	/**
	 * @static
	 * @param  $mapper
	 * @param null $id
	 * @return Gacela\Model
	 */
	public static function find($mapper, $id = null)
	{
		return self::load(ucfirst($mapper))->find($id);
	}

	/**
	 * @static
	 * @param  $mapper
	 * @param Gacela\Criteria|null $criteria
	 * @return Gacela\Collection
	 */
	public static function find_all($mapper, Gacela\Criteria $criteria = null)
	{
		return self::load(ucfirst($mapper))->findAll($criteria);
	}

	/**
	 * @static
	 * @return Gacela\Criteria
	 */
	public static function criteria()
	{
		$criteria = self::instance()->autoload('\\Criteria');
		return new $criteria();
	}

	public function autoload($class)
	{
		$parts = explode("\\", $class);
		$self = self::instance();

		if (isset($self->_namespaces[$parts[0]])) {
			$file = $self->_namespaces[$parts[0]] . str_replace("\\", "/", $class) . '.php';
			if ($self->_findFile($file)) {
				require $file;
				return $class;
			}
		} else {
			$namespaces = array_reverse($self->_namespaces);
			foreach ($namespaces as $ns => $path) {
				$file = $path . $ns . str_replace("\\", "/", $class) . '.php';

				if ($self->_findFile($file)) {
					require $file;
					return $ns . $class;
				}
			}
		}

		return false;
	}
}
