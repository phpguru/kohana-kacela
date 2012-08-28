<?php

namespace Kacela\DataSource\Query;

use Gacela\DataSource\Query as Q;

class Sql extends Q\Sql {

	/**
	 * A convenience wrapper for join
	 * @param  string|array $table
	 * @param  string $on
	 * @param array $columns
	 * @param string $type
	 * @return Query\Sql
	 */
	public function left_join($table, $on, array $columns = array())
	{
		return $this->leftJoin($table, $on, $columns);
	}

	/**
	 * A convenience wrapper for join
	 * @param  string|array $table
	 * @param  string $on
	 * @param array $columns
	 * @param string $type
	 * @return Query\Sql
	 */
	public function right_join($table, $on, array $columns = array())
	{
		return $this->rightJoin($table, $on, $columns);
	}

}
