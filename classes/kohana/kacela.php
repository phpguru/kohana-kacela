<?php
/**
 * @author noah
 * @date 3/26/11
 * @brief
 *
*/

require MODPATH.'kacela'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'Gacela'.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'Gacela.php';

class Kohana_Kacela extends Gacela {

	public static function count($mapper, \Gacela\Criteria $criteria = null)
	{
		return static::load($mapper)->count($criteria);
	}

	/**
	 * @static
	 * @return Gacela\Criteria
	 */
	public static function criteria()
	{
		$criteria = static::instance()->autoload('\\Criteria');
		return new $criteria();
	}

	public static function factory($mapper, $id = null)
	{
		if(is_null($id))
		{
			return static::load($mapper)->load((object) array());
		}

		return static::find($mapper, $id);
	}

	/**
	 * @static
	 * @param  $mapper
	 * @param null $id
	 * @return Gacela\Model
	 */
	public static function find($mapper, $id = null)
	{
		return static::load($mapper)->find($id);
	}

	/**
	 * @static
	 * @param  $mapper
	 * @param Gacela\Criteria|null $criteria
	 * @return Gacela\Collection
	 */
	public static function find_all($mapper, \Gacela\Criteria $criteria = null)
	{
		return static::load($mapper)->find_all($criteria);
	}

	/**
	 * @static
	 * @return \Kacela
	 */
	public static function instance()
	{
		if (is_null(static::$_instance)) {
			static::$_instance = new Kacela();
		}

		return static::$_instance;
	}

	/**
	 * @static
	 * @param  $mapper
	 * @return Kacela_Mapper
	 */
	public static function load($mapper)
	{
		return static::instance()->load_mapper(ucfirst($mapper));
	}

	/**
	 * @param string $class
	 * @return string
	 */
	public function autoload($class)
	{
		if(stripos($class, 'Gacela') === 0) {
			return parent::autoload($class);
		}

		$class = str_replace("\\", '_', trim($class, "\\"));

		if(stripos($class, 'Kacela') !== 0 AND strpos($class, 'Mapper') === false AND strpos($class, 'Model') === false)
		{
			$class = 'Kacela_'.$class;
		}

		return $class;
	}

	/**
	 * @param  $key
	 * @param null $object
	 * @return object|bool
	 */
	public function cache($key, $object = null, $replace = false)
	{
		if(!$this->_cacheData AND ($this->_cacheSchema === false OR (stristr($key, 'resource_') === false AND stristr($key, 'mapper_') === false)))
		{
			if (is_null($object))
			{
				if (isset($this->_cached[$key]))
				{
					return $this->_cached[$key];
				}

				return false;
			}
			else
			{
				$this->_cached[$key] = $object;

				return true;
			}
		}
		else
		{
			if (is_null($object))
			{
				return $this->_cache->get($key);
			}
			else
			{
				return $this->_cache->set($key, $object);
			}
		}
	}

	public function enable_cache(Cache $cache, $schema = true, $data = true)
	{
		$this->_cache = $cache;

		$this->_cacheSchema = $schema;
		$this->_cacheData = $data;

		return $this;
	}

	/**
	 * @param $name
	 * @return Gacela\DataSource\iDataSource
	 */
	public function get_datasource($name)
	{
		return parent::getDataSource($name);
	}

	/**
	 * @throws Exception
	 * @param  string $name Relative name of the Mapper to load. For example, if the absolute name of the mapper was \App\Mapper\User, you would pass 'user' in as the argument
	 * @return Gacela\Mapper\Mapper
	 */
	public function load_mapper($name)
	{
		return parent::loadMapper($name);
	}

	/**
	 * Collection factory method
	 *
	 * @param \Gacela\Mapper\Mapper $mapper
	 * @param array $data
	 * @return \Gacela\Collection\Collection
	 * @throws Exception
	 */
	public function make_collection($mapper, $data)
	{
		return parent::makeCollection($mapper, $data);
	}

	/**
	 * @param $name
	 * @param $type
	 * @param $config
	 * @return Gacela
	 */
	public function register_datasource($name, $type, $config)
	{
		return parent::registerDataSource($name, $type, $config);
	}
}
