Usage
=====

To make the results of these commands can be acquirable by Web service,
you can add one PHP script file check.php in your web/ folder,
this script should execute these command and return the check results:

```json
[
    {
        "checkPoint": "container:debug",
        "status": "0",
        "message": "[ok]"
    },
    {
        "checkPoint": "check:doctrine:database-connection",
        "status": "0",
        "message": "doctrine:database-connection [ok]"
    },
    {
        "checkPoint": "check:doctrine:mongodb-connection",
        "status": "1",
        "message": "doctrine:mongodb-connection [ko]"
    },
    {
        "checkPoint": "check:memcache-connection",
        "status": "1",
        "message": "memcache-connection [ko]"
    },
    {
        "checkPoint": "check:rabbitmq-connection",
        "status": "1",
        "message": "rabbitmq-connection [ko]"
    }
]
```

You can find the example of check.php, [here](https://github.com/Tessi-Tms/TmsSupervisionBundle/blob/master/Resources/doc/check.php).