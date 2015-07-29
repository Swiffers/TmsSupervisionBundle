Usage
=====

To make the results of these commands can be acquirable by Web service,
you can add one PHP script file check.php in your web/ folder,
this script should execute these commad and return the check results.

```php
<?php

header('Content-Type: application/json');

$phpBin  = '/usr/bin/php';
$console = '../app/console';

$checkResults = array();
$checkPoints = array(
    'check:doctrine:database-connection',
    'check:doctrine:mongodb-connection',
    'check:memcache-connection',
    'check:rabbitmq-connection',
);

function check($phpBin, $console, $checkPoint)
{
    $output = array();
    $cmd = sprintf(
        "%s %s %s 2>&1",
        $phpBin,
        $console,
        $checkPoint
    );

    exec($cmd, $output, $returnValue);

    return array(
        'checkPoint' => $checkPoint,
        'status'     => (string) $returnValue,
        'message'    => implode('<br />', $output),
    );
}

// Test Symfony
$checkResults[] = check($phpBin, $console, 'container:debug');

if (0 == $checkResults[0]['status']) {
    $checkResults[0]['message'] = 'ok!';
    // Check Points
    foreach ($checkPoints as $checkPoint) {
        $result = check($phpBin, $console, $checkPoint);
        $checkResults[] = $result;
    }
}
echo json_encode($checkResults);

```

You can find the example of check.php, [here](https://github.com/Tessi-Tms/TmsSupervisionBundle/blob/master/Resources/doc/check.php).