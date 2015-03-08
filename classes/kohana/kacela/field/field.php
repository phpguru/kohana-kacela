<?php

use Gacela\Field as F;

class Kohana_Kacela_Field_Field extends F\Field
{
	protected static function _singleton()
	{
		return \Kacela::instance();
	}
}
