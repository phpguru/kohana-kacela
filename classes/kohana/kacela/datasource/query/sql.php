<?php

use Gacela\DataSource\Query as Q;

class Kohana_Kacela_DataSource_Query_Sql extends Q\Sql
{

	/**
	 * A convenience wrapper for join
	 * @param  string|array $table
	 * @param  string $on
	 * @param array $columns
	 * @param string $type
	 * @return Sql
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
	 * @return Sql
	 */
	public function right_join($table, $on, array $columns = array())
	{
		return $this->rightJoin($table, $on, $columns);
	}

}