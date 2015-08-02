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

if ('0' === $checkResults[0]['status']) {
    $checkResults[0]['message'] = '[ok]';
    // Check Points
    foreach ($checkPoints as $checkPoint) {
        $result = check($phpBin, $console, $checkPoint);
        $checkResults[] = $result;
    }
}
echo json_encode($checkResults);
