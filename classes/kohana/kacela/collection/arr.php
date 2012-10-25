<?php

use Gacela\Collection as C;

class Kohana_Kacela_Collection_Arr extends C\Arr
{
	public function as_array()
	{
		return call_user_func_array('parent::asArray', func_get_args());
	}
}
