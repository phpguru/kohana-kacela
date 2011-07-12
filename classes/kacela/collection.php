<?php
/** 
 * @author noahg
 * @date 7/12/11
 * @brief
 * 
 */

namespace Kacela;

use Gacela as G;

class Collection extends G\Collection
{
	public function as_array()
	{
		return call_user_func_array(array($this, 'asArray'), func_get_args());
	}
}
