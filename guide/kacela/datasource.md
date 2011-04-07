# Theory of Operation

Kacela can hold references to many data sources at a single time, though the most common and default datasource is the 'db' datasource.

A DataSource represents a specific source of data to be consumed by your application. DataSources can include databases, web services, xml files, other files or
anything else you can come up with.

Each type of DataSource will also have its own type of Query object as well as a Resource object that will be utilized when loading discreet resources from the
DataSource.

# Executing queries against the DataSource

### public function query($query);

#### Arguments

$query - A valid representation of a query for the DataSource

#### Returns

An array of records returned from the query

### public function insert($name, $data);

#### Arguments

* $name - Name of the resource into which $data will be inserted
* $data - Can be an array representing a single row or can be an array of rows to insert.

#### Returns

The last insert id from the data source

### public function update($name, $data, Gacela\Criteria $where);

### Arguments

* $name - Name of the resource to be updated
* $data - An associative array of columns to be updated
* $where - A Criteria object with the appropriate conditionals for specifying which rows to update

#### Returns

True on success

### public function delete($name, Gacela\Criteria $where);

#### Arguments

* $name - Name of the resource to be updated
* $where - A Criteria object with the appropriate conditionals for specifying which rows to delete

#### Returns

True on success

# DataSource specific Query Object

### public function getQuery();

#### Returns

Query Builder specific to the DataSource

# DataSource Resources

### public function loadResource($name);