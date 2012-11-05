<?php
/**
 * @author noah
 * @date 3/26/11
 * @brief
 *
*/

require MODPATH.'kacela'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'Gacela'.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'Gacela.php';

class Kohana_Kacela extends Gacela
{
	/**
	 * @var Kohana_Cache
	 */
	protected $_cache;

	/**
	 * @static
	 * @param array $config
	 * @return mixed
	 */
	public static function create_datasource(array $config)
	{
		return parent::createDataSource($config);
	}

	/**
	 * @static
	 * @param $mapper
	 * @param Gacela\Criteria $criteria
	 * @return mixed
	 */
	public static function count($mapper, \Gacela\Criteria $criteria = null)
	{
		return static::load($mapper)->count($criteria);
	}

	/**
	 * @static
	 * @return Kacela_Criteria
	 */
	public static function criteria()
	{
		$criteria = static::instance()->autoload('\\Criteria');
		return new $criteria();
	}

	/**
	 * @static
	 * @param $mapper
	 * @param null $id
	 * @return Kacela_Model
	 */
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
	 * @return Kacela_Model
	 */
	public static function find($mapper, $id = null)
	{
		return static::load($mapper)->find($id);
	}

	/**
	 * @static
	 * @param  $mapper
	 * @param Gacela\Criteria|null $criteria
	 * @return Gacela\Collection\Collection
	 */
	public static function find_all($mapper, \Gacela\Criteria $criteria = null)
	{
		return static::load($mapper)->find_all($criteria);
	}

	/**
	 * @static
	 * @return Kacela
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
	 * @param $key
	 * @param null $value
	 * @return bool|object
	 */
	public function cache_metadata($key, $value = null)
	{
		return $this->cacheMetaData($key, $value);
	}

	public function enable_cache(Cache $cache)
	{
		$this->_cache = $cache;

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
		$name = ucfirst($name);

		if(stripos($name, 'Mapper') === false) {
			$name = "Mapper_" . $name;
		}

		$name = $this->autoload($name);

		$cached = $this->cache_metadata($name);

		if (!$cached) {
			$cached = new $name();

			$this->cache_metadata($name, $cached);
		}

		return $cached;
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
	public function register_datasource(Gacela\DataSource\iDataSource $source)
	{
		return parent::registerDataSource($source);
	}

	/**
	 * @param  $key
	 * @param null $object
	 * @return object|bool
	 */
	protected function _cache($key, $object = null)
	{
		if(!is_object($this->_cache)) {
			if(is_null($object)) {
				if(isset($this->_cached[$key])) {
					return $this->_cached[$key];
				}

				return false;
			} else {
				$this->_cached[$key] = $object;

				return true;
			}
		} else {

			if(is_null($object)) {
				return $this->_cache->get($key);
			} else {
				return $this->_cache->set($key, $object);
			}
		}
	}
}
