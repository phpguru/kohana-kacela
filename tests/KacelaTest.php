<?php

/**
 * @group kacela
 * @package Kacela
 * @category Tests
 */
class KacelaTest extends Unittest_TestCase
{
	/**
	 * @var Kacela
	 */
	protected $object;

	protected $memcache;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	public function setUp()
	{
		$this->object = Kacela::instance();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		Kacela::reset();

		Cache::instance()->delete_all();
	}

	public function test_instance()
	{
		$this->assertInstanceOf('Kacela', Kacela::instance());
	}

	public function test_create_datasource()
	{
		$arr = array
		(
			'name' => 'db',
			'type' => 'mysql',
			'schema' => 'kacela',
			'user' => '',
			'password' => ''
		);

		$source = Kacela::createDataSource($arr);

		$this->assertInstanceOf('Kacela_DataSource_Database', $source);

		return $source;
	}

	/**
	 * @param Gacela\DataSource\iDataSource $source
	 * @depends test_create_datasource
	 */
	public function test_register_datasource(Gacela\DataSource\iDataSource $source)
	{
		$this->object->register_datasource($source);

		$this->assertAttributeSame(array('db' => $source), '_sources', $this->object);

		return $source;
	}

	/**
	 * @depends test_register_datasource
	 */
	public function test_get_datasource($source)
	{
		$this->object->register_datasource($source);

		$source = $this->object->get_datasource($source->getName());

		$this->assertInstanceOf('Kacela_DataSource_Database', $source);

		return $source;
	}

	/**
	 * @param $name
	 * @param $expected
	 * @covers Kacela::load_mapper
	 * @depends test_get_datasource
	 */
	public function test_load_mapper()
	{
		$source = Kacela::create_datasource
		(
			array
			(
				'name' => 'db',
				'type' => 'mysql',
				'host' => 'localhost',
				'schema' => 'kacela',
				'user' => 'kacela',
				'password' => 'kacela'
			)
		);

		$this->object->register_datasource($source);

		$this->assertInstanceOf('Mapper_House', $this->object->load_mapper('house'));
	}

	public function test_load_mapper_with_cache()
	{
		$source = Kacela::create_datasource
		(
			array
			(
				'name' => 'db',
				'type' => 'mysql',
				'host' => 'localhost',
				'schema' => 'kacela',
				'user' => 'kacela',
				'password' => 'kacela'
			)
		);

		$this->object->register_datasource($source);

		$this->assertNull(Cache::instance()->get('Mapper_House'));

		$this->object->enable_cache(Cache::instance());

		$this->assertInstanceOf('Mapper_House', $this->object->load_mapper('house'));

		$this->assertInstanceOf('Mapper_House', Cache::instance()->get('Mapper_House'));
	}
}
