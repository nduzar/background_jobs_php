<?php

namespace App\BackgroundJobs;

use Exception;
use Illuminate\Support\Facades\Log;

class BackgroundJobRunner
{
    public static function run($className, $methodName, $params = [], $attempt = 1)
    {
        \Log::info("Attempting to run job", ['class' => $className, 'method' => $methodName]);

        $className = '\\' . str_replace(['/', 'Jobs'], ['\\', '\\Jobs\\'], $className);

        try {
            // Validate class and method names
            if (!class_exists($className) || !method_exists($className, $methodName)) {
                throw new Exception("Invalid class or method name");
            }

            // Instantiate the class and call the method
            $instance = new $className();
            $result = call_user_func_array([$instance, $methodName], $params);

            // Log successful execution
            Log::info("Background job executed successfully", [
                'class' => $className,
                'method' => $methodName,
                'params' => $params,
                'result' => $result,
                'attempt' => $attempt
            ]);

            return $result;
        } catch (Exception $e) {
            // Log error
            Log::error("Background job execution failed", [
                'class' => $className,
                'method' => $methodName,
                'params' => $params,
                'error' => $e->getMessage(),
                'attempt' => $attempt
            ]);

            // Retry logic
            $maxRetries = config('background_jobs.max_retries', 3);
            $retryDelay = config('background_jobs.retry_delay', 5);

            if ($attempt < $maxRetries) {
                sleep($retryDelay);
                return self::run($className, $methodName, $params, $attempt + 1);
            }

            throw $e;
        }
    }
}