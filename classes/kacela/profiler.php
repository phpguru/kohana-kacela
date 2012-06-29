<?php

/**
 * Description of profiler
 *
 * @author noah
 * @date $(date)
 */
class Kacela_Profiler extends Kohana_Profiler
{
	public static function set_name($token, $name)
	{
		Profiler::$_marks[$token]['name'] = $name;
	}
}
