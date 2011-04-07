# Theory of operation

Kacela presents a singleton $_instance object that can be accessed globally from other portions of the application.

Kacela provides namespaced cascading autoloading of all Mappers, Models as well the core classes. Kacela also serves as the repository
for all registered DataSources to be used by the Mappers to load DataSource Resources.

Lastly (but most importantly as this is the most commonly used aspect), all Mappers are registered through Kacela and are accessed
through Kacela.

# Namespaces

By default Kacela and Gacela are registered as autoloaded namespaces when the Kacela instance is constructed.

### registerNamespace($namespace, $path)

#### Example

	Kacela::instance()->registerNamespace('App', '/path/to/app/namespace');

# DataSources

### registerDataSource($name, $type, $config)

#### Arguments

* $name - Name by which the DataSource can later be referenced in Mappers and when directly accessing the registered DataSource.
* $type - Type of DataSource
	* database
	* service (coming soon)
* $config - Configuration arguments required by the DataSource

#### Example

	// Registering a new Database DataSource
	$config = array
	(
		'host' => 'localhost',
		'password' => 'mypass',
		'database' => 'northwind',
		'dbtype' => 'mysql',
		'user' => 'me'
	);

	Kacela::instance()->registerDataSource('db', 'database', $config);

# Loading Models

### find($mapper, $id = null)

#### Arguments

* $mapper
	- Relative name of the Mapper to load. For example, if the absolute name of the mapper was \App\Mapper\User, you would pass 'user' in as the argument
* $id
	- Identity field(s) value(s) necessary to load the desired instance of the Model. May be a scalar value or an array.

#### Return Value

Returns a concrete instance of Gacela\Model. If a record matching $id was found in the DataSource, it will populated with the data from that record.

#### Example

	$user = Kacela::find('user', 1);

	echo Debug::vars(get_class($user));

### find_all($mapper, $criteria)

#### Example

	$criteria = Kacela::criteria();

	$criteria->like('email', '@domain.com');

	// $users is an instance of Gacela\Collection
	$users = Kacela::find_all('user', $criteria);

	foreach($users as $user)
	{
		// Emails will all contain the string @domain.com
		echo $user->email;
	}

# Loading Mappers directly

### load($mapper)



