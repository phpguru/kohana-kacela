# Download Kacela

Kacela can be downloaded from [https://github.com/gabriel1836/Kacela](https://github.com/gabriel1836/Kacela) and included
in your project under modules.

Or you can download the github repository directly as a submodule into your project

1. At the command-line, browse to /your/project/root
2. Execute "git submodule https://github.com/gabriel1836/Kacela.git modules/kacela"
3. Execute "git submodule init"
4. Execute "git submodule update"



# Initialize Kacela

1. Add kacela to your modules array in bootstrap.php
2. In modules/kacela, create init.php
3. Under application/classes, create a directory to hold your namespaced Kacela classes and the Mapper and Model directories under it for holding your
application's Mappers and Models.
3. [Register](kacela.kacela#registering-custom-application-namespaces) your application's custom namespace with the Kacela instance
4. [Register](kacela.kacela#registering-datasources) any [DataSources](kacela.datasources) with the Kacela instance