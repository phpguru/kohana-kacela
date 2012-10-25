<?php

use Gacela\Collection as C;

class Kohana_Kacela_Collection_Statement extends C\Statement
{
	public function as_array()
	{
		return call_user_func_array('parent::asArray', func_get_args());
	}
}
