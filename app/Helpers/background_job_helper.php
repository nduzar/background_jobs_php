<?php

use App\BackgroundJobs\BackgroundJobRunner;

if (!function_exists('runBackgroundJob')) {
    function runBackgroundJob($className, $methodName, $params = [])
    {
        $command = PHP_BINARY . ' ' . base_path('artisan') . ' background:run ' . $className . ' ' . $methodName . ' ' . json_encode($params);

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            pclose(popen('start /B ' . $command, 'r'));
        } else {
            exec($command . ' > /dev/null 2>&1 &');
        }
    }
}