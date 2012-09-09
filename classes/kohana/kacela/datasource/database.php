<?php

use Gacela\DataSource as D;

class Kohana_Kacela_DataSource_Database extends D\Database
{
	public function load_resource($resource)
	{
		return parent::loadResource($resource);
	}
}
