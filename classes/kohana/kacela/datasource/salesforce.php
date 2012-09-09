<?php

use Gacela\DataSource\Salesforce as S;

class Kohana_Kacela_DataSource_Salesforce extends S
{
	public function load_resource($resource)
	{
		return parent::loadResource($resource);
	}
}
