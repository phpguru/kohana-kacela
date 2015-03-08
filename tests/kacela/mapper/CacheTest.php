<?php
/**
 * @user: noah
 * @date 11/14/12
 */
class CacheTest extends Kacela_Unittest_Database_TestCase
{
	/**
	 * @var Kohana_Cache
	 */
	protected $cache;

	public function setUp()
	{
		parent::setUp();

		$this->cache = Cache::instance('memcache');

		Kacela::instance()->enable_cache($this->cache);

		$this->assertAttributeInstanceOf('Kohana_Cache', '_cache', Kacela::instance());

		$this->cache->delete_all();
	}

	public function tearDown()
	{
		parent::tearDown();

		$this->cache->delete_all();
	}

	protected function getDataSet()
	{
		return $this->createArrayDataSet(array());
	}

	public function testFindWithoutPrimedCache()
	{

	}

	public function testFindAllWithoutCriteria()
	{

	}
}
