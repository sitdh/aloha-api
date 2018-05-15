# API Provider

** DOCKER REQUIRED **

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