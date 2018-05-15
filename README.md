# API Provider

** DOCKER REQUIRED **

![API Page Preview][preview]


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

Open [localhost](http://localhost) to preview application

## Script fixing
1. Change `DROP TABLE properties` to `DROP TABLE IF EXISTS properties` to prevent error.
1. Run `sed` to convert string to date
  ```bash
  $ sed -ie "s/,'04-08-2016',/,STR_TO_DATE('04-08-2016'),/g" property_data.sql
  $ sed -ie "s/,'05-08-2016',/,STR_TO_DATE('05-08-2016'),/g" property_data.sql
  ```

[preview]: https://lh3.googleusercontent.com/LPLEzysFgaqwppBaaDwyoDXM8s-EVnNME8--YklrKlJJKsstKJ5qXgyY2eVceyhdM3Lva6WAM0HLGf-nirKYZTqYppPY0ty-f6U7UWyKPDZSovD8FvikovHv7icnZSgxix09ArjHZwb_K-USSeHMDvUa19hujBO_7MQFyLmx6auOUofnUcAe48tB9bdnB90ICB5NeKgHPItruhpMsFX9jSYf-OcXsKbgHpS_j_oXHyRawV270U4TL9MwA8dWRku6_QANRSFC2P2vAOh6_4W8hu2WeXJSb1Ke7gSqWl1-V7fb-l7tgeP29FOF5sEFDtUI1MPyTBIN4hP917b8Vb5DxRhEeTf2kTVT36r96SdfaBwfCZeZlO-WeA7tFNQ3ruDPY_j8Rkk30qh5-gpiw1y1nEjx__qtuojrVU6fL-p1UAzFIg3hZTr_RndGQ6GNoidX7Zo3CGCFnXKRcdSGFHDzV8vdF6EGgKhO8kqB7whK1D72SIyrAET9fJpsGoOKIuhHYabn5y1OEZvSBzEjSBJ8F8I6EPid1Ci9YUkMQZoD1SDWmtgNX5lV1i71lTcgPE_Eb91BrE7kAeyCsWdH_riECcmI-rovjfLYJXTVz80=w1680-h1760-no
