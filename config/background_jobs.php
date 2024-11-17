<?php

return [
    'max_retries' => 3,
    'retry_delay' => 5, // seconds
    'allowed_classes' => [
        // Add your allowed class names here
        'App\Jobs\ExampleJob',
    ],
];