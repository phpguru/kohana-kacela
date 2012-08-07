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
		return self::load($mapper)->count($criteria);
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

	public static function factory($mapper, $id = null)
	{
		if(is_null($id))
		{
			return self::load($mapper)->load((object) array());
		}

		return self::find($mapper, $id);
	}

	/**
	 * @static
	 * @param  $mapper
	 * @param null $id
	 * @return Gacela\Model
	 */
	public static function find($mapper, $id = null)
	{
		return self::load($mapper)->find($id);
	}

	/**
	 * @static
	 * @param  $mapper
	 * @param Gacela\Criteria|null $criteria
	 * @return Gacela\Collection
	 */
	public static function find_all($mapper, \Gacela\Criteria $criteria = null)
	{
		return self::load($mapper)->find_all($criteria);
	}

	/**
	 * @static
	 * @return Gacela
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new Kacela();
		}

		return self::$_instance;
	}

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
	 * @param  string $class
	 * @return bool|string
	 */
	public function autoload($class)
	{
		$parts = explode("\\", $class);
		$self = self::instance();

		if (isset($self->_namespaces[$parts[0]]))
		{
			if (class_exists($class))
			{
				return $class;
			}
			elseif ($parts[0] == 'Gacela')
			{
				return parent::autoload($class);
			}
			else
			{

				$path = $parts;
				unset($path[0]);

				$path = join(DIRECTORY_SEPARATOR, $path);

				$file = $self->_namespaces[$parts[0]].strtolower($path).'.php';

				if ($self->_findFile($file))
				{
					require $file;
					return $class;
				}
			}
		}
		else
		{
			$namespaces = array_reverse($self->_namespaces);

			foreach ($namespaces as $ns => $path)
			{
				if ($ns == 'Gacela')
				{
					return parent::autoload($class);
				}

				if (substr($class, 0, 1) == '\\')
				{
					$tmp = substr($class, 1);
				}
				else
				{
					$tmp = $class;
				}

				$file = $path.strtolower(str_replace("\\", DIRECTORY_SEPARATOR, $tmp)).'.php';

				if ($self->_findFile($file))
				{
					$class = $ns . $class;

					if (class_exists($class))
					{
						return $class;
					}
					else
					{
						require $file;
						return $class;
					}
				}
			}
		}

		return false;
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

	public function get_datasource($name)
	{
		return parent::getDataSource($name);
	}

	public function incrementCache($key)
	{
		if (!$this->_cacheData) {
			$this->_cached[$key]++;
		} else {
			$val = $this->_cache->get($key);
			$val++;

			$this->_cache->set($key, $val);
		}
	}

	public function register_datasource($name, $type, $config)
	{
		return parent::registerDataSource($name, $type, $config);
	}

	public function register_namespace($ns, $path)
	{
		return parent::registerNamespace($ns, $path);
	}
}
