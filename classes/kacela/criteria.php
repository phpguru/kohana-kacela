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
		return $this->greaterThan($field, $value, $or);
	}

	public function is_null($field, $or = false)
	{
		return $this->isNull($field, $or);
	}

	public function is_not_null($field, $or = false)
	{

		return $this->isNotNull($field, $or);
	}

	public function less_than($field, $value, $or = false)
	{
		return $this->lessThan($field, $value, $or);
	}

	public function not_equals($field, $value, $or = false)
	{
		return $this->notEquals($field, $value, $or);
	}

	public function not_in($field, array $value, $or = false)
	{
		return $this->notIn($field, $value, $or);
	}

	public function not_like($field, $value, $or = false)
	{
		return $this->notLike($field, $value);
	}


}
