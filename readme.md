# Description
Application for storing and editing information about employees uses Nette framework and saves data in an XML file. The basic
workflow uses Serializer to serialize and deserialize a list of models to xml file which is then stored in an xml file. A list
of models is accessed using FileStorageService which can easily switch serialization format to JSON or csv. If a more
advanced storage method is required FileStorageService uses an interface that can be implemented by for example database
service or something. A known limitation is the absence of a method for searching one particular item from the list and range of
items which is not implemented for complexity reasons since things like pagination or search are not required since
XML file is currently a required storing method it is not expected to store huge amounts of data with the application and 
performance is not expected to degrade much with a sensible (100-1000 items) amount of data.

# Installation
best way to install this app is to use docker compose
```bash
docker compose up -d
```

# Editing user parameters
1. Add, remove or change model in ```App\DTO\EmployeeDTO.php```
2. update according to your change form in ```App\Forms\EmployeeFormFactory```
3. migrate xml data file with default location ```PROJECT_DIR/employees.xml```
