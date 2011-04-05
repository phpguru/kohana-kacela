# Active Record vs Data Mapper

## Active Record as the ORM layer

Most Object Relational Mappers implement the [Active Record pattern](http://martinfowler.com/eaaCatalog/activeRecord.html)
which is just an overloaded form of the [Row Data Gateway pattern](http://martinfowler.com/eaaCatalog/rowDataGateway.html).

In both the Row Data Gateway and Active Record patterns, a single object corresponds to a single record in the database. The Active Record
merely allows for business logic to be contained within the same object that contains the data access logic. So in a single object you would
find both an insert() method and a doSomeBusinessFunction() method.

## Data Mapper as the ORM layer

The [Data Mapper pattern](http://martinfowler.com/eaaCatalog/dataMapper.html) is at once more complex conceptually and at the same time simpler
because it uses two or more types of objects where the Active Record pattern would have used one. At the minimum, utilizing a Data Mapper
requires creating a Data Mapper object and a Model or Domain object.

In the Data Mapper pattern, methods like insert(), update(), delete() exist only in the data mapper and the domain object would contain
only business logic and related methods like doSomeBusinessFunction().

In addition, a Data Mapper is designed to map fields and metadata from multiple data resources into a single model or domain
object. 