Commands
========

This bundle use the console component of Symfony and extended these commands:

| Number | Commands                           | Description                      |
| -------| ---------------------------------- |:--------------------------------:|
| 1      | check:doctrine:database-connection | Check the connection of database |
| 2      | check:doctrine:mongodb-connection  | Check the connection of MongoDB  |
| 3      | check:memcache-connection | Check the connection of memcache          |
| 4      | check:rabbitmq-connection | Check the default connection of rabbitmq  |

Every command can be used independently, if the returned value is true, it means check process is passed.
You can simply add your own command to this bundle by inherit the class ``AbstractCheckCommand``.

Database
--------
``check:doctrine:database-connection`` use the service ``doctrine`` of bundle ``DoctrineBundle``
to check the connection between your application and **relational database** (such as MySQL, PostgreSQL or Microsoft SQL)

This configuration in the app/config.yml will be used by this command:
```
# Doctrine Configuration
doctrine:
    dbal:
        connections:
            default:
                driver:   "%database_driver%"
                host:     "%database_host%"
                port:     "%database_port%"
                dbname:   "%database_name%"
                user:     "%database_user%"
                password: "%database_password%"
                charset:  UTF8
```

MongoDB
-------
``check:doctrine:mongodb-connection`` use the service ``doctrine_mongodb`` of bundle ``DoctrineMongoDBBundle``
to check the connection between your application and **MongoDB**

This configuration in the app/config.yml will be used by this command:
```
# Doctrine MongoDB Configuration
doctrine_mongodb:
    connections:
        default:
            server: mongodb://localhost:27017
            options: {}
        test:
            server: mongodb://localhost:2701
            options: {}
```

Memcache
-------
``check:memcache-connection`` use the function original ``Memcache`` of PHP
to check the connection between your application and **Memcached**

This configuration in the app/parameters.yml will be used by this command:
```
   memcache_servers: {memcached01: {host: localhost, port: 11211}}
```

RabbitMQ
-------
``check:rabbitmq-connection`` use the service ``old_sound_rabbit_mq.connection.default`` of bundle ``oldsound/rabbitmq-bundle``
to check the connection between your application and **RabbitMQ**

This configuration in the app/config.yml will be used by this command:
```
# RabbitMQ Configuration
old_sound_rabbit_mq:
    connections:
        default:
            host:     %rabbitmq_host%
            port:     %rabbitmq_port%
            user:     %rabbitmq_user%
            password: %rabbitmq_password%
            vhost:    %rabbitmq_vhost%
            lazy:     false
```