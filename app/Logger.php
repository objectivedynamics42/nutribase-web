<?php

class Logger {
    // Dynamically resolve path to log file in the application root
    private static $logFilePath;
    private static $initialized = false;

    private function __construct() {
    }

    private static function initializeLogFile() {
        if (self::$initialized) {
            return true;
        }

        // Determine root path dynamically (one level up from this file's directory)
        $rootPath = dirname(__DIR__);
        self::$logFilePath = $rootPath . DIRECTORY_SEPARATOR . "nutribase_log";

        $directory = dirname(self::$logFilePath);

        // Check if directory exists, if not fail early (safer than mkdir without permission)
        if (!is_dir($directory)) {
            throw new RuntimeException("Log directory does not exist: $directory");
        }

        // Check if file exists, if not try to create it
        if (!file_exists(self::$logFilePath)) {
            if (!touch(self::$logFilePath)) {
                throw new RuntimeException("Failed to create log file: " . self::$logFilePath);
            }
            chmod(self::$logFilePath, 0644);
        }

        // Verify the file is writable
        if (!is_writable(self::$logFilePath)) {
            throw new RuntimeException("Log file is not writable: " . self::$logFilePath);
        }

        self::$initialized = true;
        return true;
    }

    public static function log($message) {
        try {
            self::initializeLogFile();
            $timestamp = date("Y-m-d H:i:s");
            if (error_log($timestamp . " " . $message . "\n", 3, self::$logFilePath) === false) {
                throw new RuntimeException("Failed to write to log file: " . self::$logFilePath);
            }
        } catch (RuntimeException $e) {
            // Optional: log to default PHP error log or ignore
            error_log("Logger error: " . $e->getMessage());
        }
    }
}
