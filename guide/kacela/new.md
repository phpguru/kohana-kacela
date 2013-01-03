# Mapping Data Structures to PHP Objects

Most useful applications interact with data in some form. There are multiple solutions for storing data and for each of those solutions, sometimes multiple formats in which the data can be stored.
When using object-oriented PHP, that same data is stored, modified and accessed in a class.

Let's assume that you were creating your own internal database of local hoodlums to call when you're in a pinch. We'll assume that these locals can be reached by phone or email.
When calling you'll need to know what other names they might be known as so you can be sure to find them.

Storing the data in a hierarchal format with XML is fairly straightforward. Each 'local' is represented by a node named 'local' with a child 'aliases' node to contain the local's aliases.
~~~~
<xml version="1.0>
	<local id="1" name="Bobby Mcintire" email="bobby@kacela.com" phone="1234567891" />
	<local id="2" name="Frankfurt McGee" email="sweetcheeks@kacela.com" phone="9876543214">
		<aliases>
			<alias>Sweetcheeks McGee</alias>
			<alias>Cryin' McGee</alias>
			<alias>Hot Dog</alias>
		</aliases>
	</local>
</xml>
~~~~

With a relational database, we would create two tables, one to hold the basic information about each local, and a table to hold their aliases.

'locals' table

id  | name           | email                    | phone
--------------------------------------------------------
1  | Bobby Mcintire  | bobby@kacela.com               | 1234567891
2  | Frankfurt McGee | sweetcheeks@kacela.com         | 9876543214

'aliases' table

id | alias
----------
2  | Sweetcheeks McGee
2  | Cryin' McGee
2  | Hot Dog


The same data in PHP would be stored in classes like so:

~~~~
class Local {

	protected $data = array(
		'id' => 1,
		'name' => 'Bobby Mcintire',
		'email' => 'bobby@kacela.com',
		'phone' => '1234567891'
	);

	protected $aliases = array();

}

class Local {

	protected $data = array(
		'id' => 2,
		'name' => 'Frankfurt McGee',
		'email' => 'sweetcheeks@kacela.com',
		'phone' => '9876543214'
	);

	protected $aliases = array(
		'Sweetcheeks McGee',
		'Cryin' McGee',
		'Hot Dog'
	);

}
~~~~

As you can see the way that data is stored can be vastly different from the way that we interact with data in our application code.
This is called the object-impedance mismatch. A common design pattern has arisen to hide the complexities of the differences between data in application code and data stores called Object-Relational Mapping.
This design pattern was developed specifically to deal with the complexities of mapping relational database records to objects in code, but many of the same principles apply when dealing with any form of raw data because there is almost always some mismatch.

# Common Solutions

The most common approach to Object-Relational Mapping, or ORM for short, is the Active Record pattern.
This is the pattern used by Kohana's default ORM so we will use Kohana_ORM for our examples.

With Active Record, one object represents one Record from the Data Source.
With an Active Record object, business logic and data access logic are contained in a single object.
A basic Active Record object would look like so:

~~~~
class Model_Local extends ORM
{
	// Note that aliases which are stored in another table cannot be fetched yet
}
~~~~

And would be accessed like so:

~~~~
$local = ORM::find('local', 1);

// echo's Bobby Mcintire to the screen
echo $local->name;

$local->phone = '9875412356'

$local->save();
~~~~

# Kacela's Basic Philosophies

Working with a Data Mapper for the first time can be quite a bit more difficult than working with a more basic approach like Active Record, but Kacela offers large dividends if
you tackle the complexity upfront. When developing Kacela, the following were just the top features we thought every ORM should have:

- Automatically discover relationships between objects and rules about the data contained within objects.
- Separate data store activities from business logic activities so that our classes have a single responsibility.
- Defaults that are easy to set up and use, but can handle complex mapping between business objects and the underlying data store.


# Installation and Configuration

## How to Install

1. At the command-line, browse to /your/project/root
2. Execute git submodule add https://github.com/noah-goodrich/kohana-kacela modules/kacela
3. Execute git submodule init
4. Execute git submodule update

## Configuration

Configuration settings for Kacela are stored in modules/kacela/kacela.php. This file can be copied to application/config and modified.

	return array
	(
		/**
		 * List of data sources and connection params
		 */
		'datasources' => array
		(
			/**
			 * db is the default data source for Mappers
			 * PDO is the
			 */
			'db' => array
			(
				/**
				 * Valid types are: mysql (More will be added soon)
				 */
				'type' => 'mysql',
				/**
				 * Database name
				 */
				'schema' => 'kacela',
				/**
				 * Connection host
				 */
				'host' => 'localhost',
				/**
				 * Database username
				 */
				'user' => 'root',
				/**
				 * Database password
				 */
				'password' => ''
			),
			/**
			 *
			 */
			'sf' => array
			(
				'type' => 'salesforce',
				/**
				 * Kacela uses the Force.com toolkit for PHP.
				 * It can be found here: https://github.com/developerforce/Force.com-Toolkit-for-PHP
				 * Once installed in your application, Kacela needs to know the path to the soap client.
				 */
				'soapclient_path' => MODPATH.'sf/vendor/soapclient/',
				/**
				 * Specify the full path to your wsdl file for Salesforce
				 */
				'wsdl_path' => APPPATH.'config/sf.wsdl',
				'username' => 'salesforceuser@domain.com.sandbox',
				'password' => 'SecretPasswordWithSalesforceHash',
				/**
				 * Specifies which Salesforce objects are available for use in Kacela
				 */
				'objects' => array()
			)
		),
		/**
		 * Can specify TRUE to use default Cache::instance() otherwise, specify Cache group name
		 */
		'cache' => false,
		/**
		 * Set to TRUE causes the Kohana_Profiler to run for Kacela
		 */
		'profiling' => false
	);

