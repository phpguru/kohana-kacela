<?php
/**
 * @author Noah Goodrich
 * @date 8/6/11
 * @brief
 *
*/

namespace Kacela;

use Gacela as G;

class Criteria extends G\Criteria {

	public function greater_than($field, $value, $or = false)
	{
		return $this->greaterThan($field, $value);
	}

	public function is_null($field, $or = false)
	{
		return $this->isNull($field);
	}

	public function is_not_null($field, $or = false)
	{

		return $this->isNotNull($field);
	}

	public function less_than($field, $value, $or = false)
	{
		return $this->lessThan($field, $value);
	}

	public function not_equals($field, $value, $or = false)
	{
		return $this->notEquals($field, $value);
	}

	public function not_in($field, array $value, $or = false)
	{
		return $this->notIn($field, $value);
	}

	public function not_like($field, $value, $or = false)
	{
		return $this->notLike($field, $value);
	}


}
