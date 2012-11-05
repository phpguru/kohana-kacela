<?php
/**
 * Created by JetBrains PhpStorm.
 * User: noah
 * Date: 10/5/12
 * Time: 9:27 PM
 * To change this template use File | Settings | File Templates.
 */
class ModelTest extends Unittest_TestCase
{
	protected $model = null;

	public function setUp()
	{
		parent::setUp();

		$this->model = new Model_House(Kacela::instance(), Kacela::load('house'));
	}

	public function test_get_form()
	{
		$this->assertInstanceOf('Formo_Form', $this->model->get_form());
	}
}
