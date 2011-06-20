<?php
/** 
 * @author noahg
 * @date 6/15/11
 * @brief
 * 
 */

//defined('SYSPATH') OR die('No direct access allowed.');

namespace Kacela\Mapper;

use Gacela\Mapper as M;

class Mapper extends M\Mapper implements iMapper {

	public function find_all(\Gacela\Criteria $criteria = null)
	{
		return parent::findAll($criteria);
	}
}
