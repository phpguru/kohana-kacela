<?php
/**
 * @user: noah
 * @date 11/8/12
 */
abstract class Kacela_Unittest_Database_TestCase extends Kohana_Unittest_Database_TestCase
{
	private $conn;

	public function getConnection()
	{
		$db = Kacela::instance()->getDataSource('db');

		$adapter = new ReflectionProperty($db, '_adapter');

		$adapter->setAccessible(true);

		$adapter = $adapter->getValue($db);

		$adapter->loadConnection();

		$conn = new ReflectionProperty($adapter, '_conn');

		$conn->setAccessible(true);

		$pdo = $conn->getValue($adapter);

		if(is_null($this->conn)) {
			$this->conn = $this->createDefaultDBConnection($pdo);
		}

		return $this->conn;
	}

	/**
	 * Creates a new Array DataSet with the given $array.
	 *
	 * @param string $xmlFile
	 * @return Kacela_Unittest_Database_Dataset_Array
	 */
	protected function createArrayDataSet(array $array)
	{
		return new Kacela_Unittest_Database_Dataset_Array($array);
	}
}
