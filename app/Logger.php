<?php

class Logger {
    private static $logFilePath = "/data03/object/public_html/nutribase_log";
    private static $initialized = false;

    private function __construct() {
    }

    private static function initializeLogFile() {
        if (self::$initialized) {
            return true;
        }

        $directory = dirname(self::$logFilePath);

        // Check if directory exists, if not try to create it
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true)) {
                throw new RuntimeException("Failed to create log directory: $directory");
            }
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
        self::initializeLogFile();
        
        $timestamp = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS        
        if (error_log($timestamp . " " . $message . "\n", 3, self::$logFilePath) === false) {
            throw new RuntimeException("Failed to write to log file: " . self::$logFilePath);
        }
    }
}
