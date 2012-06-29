<?php
/**
 * @author noahg
 * @date 6/15/11
 * @brief
 *
 */

//defined('SYSPATH') OR die('No direct access allowed.');

namespace Kacela\Mapper;

use Gacela\Mapper as M;

abstract class Mapper extends M\Mapper implements iMapper {

	protected function _runQuery($query, $args = null, \Gacela\DataSource\Resource $resource = null)
	{
		$token = $this->_start_profile();
		$return = parent::_runQuery($query, $args, $resource);
		$this->_stop_profile($token);

		return $return;
	}

	protected function _singleton()
	{
		return \kacela::instance();
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
