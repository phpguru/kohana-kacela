<?php

use Gacela\Field as F;

class Kohana_Kacela_Field_Field extends F\Field
{
	protected static function _singleton()
	{
		return \Kacela::instance();
	}

	protected static function _class($type)
	{
		if(!isset(self::$_classes[$type]))
		{
			self::$_classes[$type] = self::_singleton()->autoload("Kacela_Field_".ucfirst($type));
		}

		return self::$_classes[$type];
	}
}
