<?php

namespace App\Helpers;

/**
 * Format response.
 */
class AlertFormatter
{
    /**
     * Alert Response
     *
     * @var array
     */
    protected static $response = [
        'status' => "green",
        'type' => "green"
    ];

    /**
     * Give success response.
     */
    public static function success($message = null)
    {
        self::$response['message'] = $message;

        return self::$response;
    }

    /**
     * Give info response.
     */
    public static function info($message = null)
    {
        self::$response['status'] = 'blue';
        self::$response['message'] = $message;

        return self::$response;
    }
    /**
     * Give warning response.
     */
    public static function warning($message = null)
    {
        self::$response['status'] = 'yellow';
        self::$response['message'] = $message;

        return self::$response;
    }
    /**
     * Give danger response.
     */
    public static function danger($message = null)
    {

        self::$response['status'] = 'red';
        self::$response['message'] = $message;

        return self::$response;
    }
}