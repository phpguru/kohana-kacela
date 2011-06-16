<?php
/** 
 * @author noahg
 * @date 6/16/11
 * @brief
 * 
 */

namespace Kacela\DataSource;

use Gacela\DataSource as D;

class DataSource extends D\DataSource
{
	protected function _singleton()
	{
		return \Kacela::instance();
	}
}
