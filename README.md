# API Provider

** DOCKER REQUIRED **

## Features
1. User `/search` endpoint to search information
  - Simple condition: `key=value` is converted to `key [op] 'value'`
  - Range condition: `key=min-max` is converted to `key between (min, max)`
2. Multiple params can be performed: 
  - `key1=value1&key2=value2` is converted to `key1 [op] 'value1' AND key1 [op] 'value2'`
3. Data was returned in JSON format

## Instructions
```bash
# Enter project path
$ cd /path/to/project

# Start service
$ docker-compose up -d --build

# http://localhost still broken, 
# please run command below to install dependency packages 
$ docker exec -it aloha-api\_fpm\_1 php composer.phar install
```

## Script fixing
1. Change `DROP TABLE properties` to `DROP TABLE IF EXISTS properties` to prevent error.
1. Run `sed` to convert string to date
  ```bash
  $ sed -ie "s/,'04-08-2016',/,STR_TO_DATE('04-08-2016'),/g" property_data.sql
  $ sed -ie "s/,'05-08-2016',/,STR_TO_DATE('05-08-2016'),/g" property_data.sql
  ```
