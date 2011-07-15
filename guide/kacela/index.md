# Kacela

Kacela is the Kohana specific implementation of the stand-alone data mapper library GacelaPHP.

For full documentation on GacelaPHP go to [the project site](http://gacelaphp.com).

The documentation contained here is specifically to cover where Kacela deviates from Gacela.

## Configuration

	return array
	(
		// Specify what namespaces are supported as well as the full path to
		// directory containing the namespaced classes
		// Gacela, Kacela, and App are all specified as default namespaces.
		'namespaces' => array
		(
			'App' => APPPATH.'classes/',
			'Kacela' => MODPATH.'kacela/classes/kacela/'
		),
		// Specify the DataSources supported within your application
		// Currently only the database type and mysql dbtype are supported.
		'datasources' => array
		(
			'db' => array
			(
				'type' => 'database',
				'dbtype' => 'mysql',
				'schema' => 'gacela',
				'host' => 'localhost',
				'user' => 'root',
				'password' => ''
			)
		),
		// If set to true, then when Kacela initializes it will attempt to enable its cache.
		'cache' => false
	);

## Kacela factory methods

Kacela supports a number of factory methods to create an interface similar to the other libraries within Kohana.

	// Returns a Model instance from the specified mapper
	kacela::find($mapper, $id);

	// Returns a Collection of Models from the specified mapper.
	// Takes a optional Criteria object.
	kacela::find_all($mapper, [$criteria]);

	// Returns a new Criteria instance.
	kacela::criteria();

	// Returns the requested Mapper instance
	kacela::load($mapper);

* There is presently a bug with the Kohana_Cache_Memcache driver where replace() is not used properly.
There is a bug report on dev.kohanaframework.org. In the meantime a fix has been implemented in my own 3.1/develop branch of the Kohana_Cache
which is available on [github](git@github.com:gabriel1836/cache.git).