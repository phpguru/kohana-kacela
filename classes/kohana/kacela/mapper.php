<?php
/**
 * @author noahg
 * @date 6/15/11
 * @brief
 *
 */

use Gacela\Mapper as M;

abstract class Kohana_Kacela_Mapper extends M\Mapper
{

	/**
	 * @param \PDOStatement | array $data
	 * @return \Gacela\Collection\Collection
	 */
	protected function _collection($data)
	{
		return $this->_singleton()->make_collection($this, $data);
	}

	/**
	 * @return Kacela_Mapper
	 */
	protected function _initModel()
	{
		if(is_null($this->_modelName))
		{
			$this->_modelName = str_replace('Mapper', 'Model', get_class($this));
		}

		return parent::_initModel();
	}

	/**
	 * @return Mapper
	 */
	protected function _initResource()
	{
		if(is_null($this->_resourceName)) {
			$class = explode('_', get_class($this));
			$class = end($class);
			$class = strtolower($class);

			$this->_resourceName = $this->_pluralize($class);
		}

		return parent::_initResource();
	}

	/**
	 * @param $string
	 * @return string
	 */
	protected function _pluralize($string)
	{
		return Inflector::plural($string);
	}

	protected function _runQuery($query, $args = null, \Gacela\DataSource\Resource $resource = null)
	{
		$token = $this->_start_profile();
		$return = parent::_runQuery($query, $args, $resource);
		$this->_stop_profile($token);

		return $return;
	}

	/**
	 * @return Kacela
	 */
	protected function _singleton()
	{
		return \kacela::instance();
	}

	/**
	 * @param $string
	 * @return string
	 */
	protected function _singularize($string)
	{
		return Inflector::singular($string);
	}

	protected function _start_profile()
	{
		$token = null;
		if(\Kohana::$profiling === true)
		{
			$token = \Profiler::start('Kacela', \Text::random());
		}

		return $token;
	}

	protected function _stop_profile($token)
	{
		if($token)
		{
			\Profiler::stop($token);

			$last = $this->_source()->lastQuery();

			if(empty($last))
			{
				\Profiler::delete($token);
			}
			else
			{
				\Profiler::set_name($token, \Kacela::debug($last, true));
			}
		}
	}

	public function count($query = null)
	{
		$token = $this->_start_profile();
		$return = parent::count($query);
		$this->_stop_profile($token);

		return $return;
	}

	public function delete(\stdClass $data)
	{
		$token = $this->_start_profile();
		$return = parent::delete($data);
		$this->_stop_profile($token);

		return $return;
	}

	public function find($id)
	{
		if(!empty($id))
		{
			$token = $this->_start_profile();
		}

		$return = parent::find($id);

		if(isset($token))
		{
			$this->_stop_profile($token);
		}

		return $return;
	}

	public function find_all(\Gacela\Criteria $criteria = null)
	{
		$token = $this->_start_profile();
		$return = parent::findAll($criteria);
		$this->_stop_profile($token);

		return $return;
	}

	public function findAllByAssociation($relation, array $data)
	{
		$token = $this->_start_profile();
		$return = parent::findAllByAssociation($relation, $data);
		$this->_stop_profile($token);

		return $return;
	}

	public function findRelation($name, $data)
	{
		$token = $this->_start_profile();
		$return = parent::findRelation($name, $data);
		$this->_stop_profile($token);

		return $return;
	}

	public function save(array $changed, \stdClass $new, array $old)
	{
		$token = $this->_start_profile();
		$return = parent::save($changed, $new, $old);
		$this->_stop_profile($token);

		return $return;
	}
}
