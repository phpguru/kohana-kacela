<?php
/** 
 * @author noahg
 * @date 6/16/11
 * @brief
 * 
 */

namespace Kacela\Mapper;

use Gacela\Mapper as M;

interface iMapper extends M\iMapper
{
	public function find_all(\Gacela\Criteria $criteria = null);
}
