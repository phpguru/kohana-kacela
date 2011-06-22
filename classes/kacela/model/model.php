<?php
/** 
 * @author noahg
 * @date 6/16/11
 * @brief
 * 
 */

namespace Kacela\Model;

use Gacela\Model as M;

class Model extends M\Model
{

	/**
	 * @throws \Exception
	 * @param  string $key
	 * @return mixed
	 */
	public function __get($key)
	{
		$method = '_get_' .$key;
		if (method_exists($this, $method)) {
			return $this->$method();
		} elseif (array_key_exists($key, $this->_relations)) {
			return $this->_mapper()->findRelation($key, $this->_data);
		} else {
			if (property_exists($this->_data, $key)) {
				return $this->_data->$key;
			}
		}

		throw new \Exception("Specified key ($key) does not exist!");
	}

	/**
	 * @param  string $key
	 * @return bool
	 */
	public function __isset($key)
	{
		$method = '_isset_'.$key;

		if (method_exists($this, $method)) {
			return $this->$method($key);
		} elseif (isset($this->_relations[$key])) {
			$relation = $this->$key;

			if ($relation instanceof \Gacela\Collection) {
				return count($relation) > 0;
			} else {
				if (!is_array($this->_relations[$key])) {
					return isset($relation->{$this->_relations[$key]});
				} else {
					// Need to support multi-field key relations
				}
			}
		}

		return isset($this->_data->$key);
	}

	/**
	 * @param  $key
	 * @param  $val
	 * @return void
	 */
	public function __set($key, $val)
	{
		$method = '_set_'.$key;

		if (method_exists($this, $method)) {
			$this->$method($val);
		} else {
			if (isset($this->_data->$key)) {
				$this->_originalData[$key] = $this->_data->$key;
			}

			$this->_changed[] = $key;

			$this->_data->$key = $this->_fields[$key]->transform($val, false);
		}
	}
	
}
