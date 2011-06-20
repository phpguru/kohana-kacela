<?php
/** 
 * @author noahg
 * @date 6/17/11
 * @brief
 * 
 */

namespace Kacela\DataSource;

use Gacela\DataSource as D;

class Database extends D\Database {

	protected function _singleton()
	{
		return \Kacela::instance();
	}
}
