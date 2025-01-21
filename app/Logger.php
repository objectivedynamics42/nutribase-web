<?php


class Logger {

    private static $logFilePath = "/data03/object/public_html/nutribase_log";

    private function __construct() {
    }

    public static function log($message) {
        $timestamp = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS        
        error_log($timestamp . " " . $message . "\n", 3, static::$logFilePath);
    }
}
