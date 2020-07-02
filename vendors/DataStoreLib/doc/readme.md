# DataStoreLib v1.0.0
    Created on June 28, 2020
    Latest version on June 28, 2020

# Tutorial

#### Basics
The system DataStoreLib uses is quite simple.
It involves using a key and a value, similar to a Python dictionary or a PHP indexed array.
There are 3 basic functions of a DataStoreLib DataStore:
**Add(key, value);**
**Remove(key);**
**Modify(key, value);**
Please note that Add and Modify do the same thing under the hood, but will be logged differently into the logging system that will be implemented soon.

#### How-tos

##### Create a DataStore
1. Include DataStoreLib.php in your php file.
2. Create a Datastore

    