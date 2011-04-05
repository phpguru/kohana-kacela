Kacela implements the following patterns from
[Patterns of Enterprise Application Architecture](http://martinfowler.com/eaaCatalog/) by Martin Fowler:

## Data Mapper

Provides a translation layer between data storage (RDBMS, web service, xml, etc) and the domain objects which consume data from
these data sources.

## Foreign Key Mapping

## Dependent Mapping

Resources (tables) exist only with the context of a parent resource. For example, phone numbers may be stored with a user id
but should not be loaded as separate domain objects but rather as a field in the user object.

## Concrete Table Inheritance

If a resource inherits from a parent resource, then all fields in the parent resource are available in the child resource.

## Query Object

This is implemented in two ways in Gacela. First in the Criteria object which is used to pass criteria to mapper methods for
loading data.

Second, each data source has a Query object which provides the facility to dynamically build queries in a format
compatible with the specific data source.

## Metadata Mapping

Foreign key relations, inheritance mapping, association table mapping, field names and meta information are all pulled
directly from the data source whenever possible. This information can be cached in files thus reducing overall
load on the data source. 

## Todo

* Examples of each design pattern will be forthcoming.
* Add Identity Map
* Add Lazy Load