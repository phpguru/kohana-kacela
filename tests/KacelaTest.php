<?php

/**
 * @group kacela
 * @package Kacela
 * @category Tests
 */
class KacelaTest extends Unittest_TestCase
{
	protected $object;

	protected $memcache;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	public function setUp()
	{
		$this->object = Kacela::instance();

		$this->memcache = new Memcache;

		$this->memcache->addServer('127.0.0.1', 11211);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		Kacela::reset();

		$this->memcache->flush();
	}

	public function testInstance()
	{
		$this->assertInstanceOf('Kacela', Kacela::instance());
	}
}
