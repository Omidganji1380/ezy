<?php


namespace App\Responses;


class Errors
{
    protected static array $_MESSAGES       = [
        'USER_NOT_FOUND' => [
            'msg'    => 'User not found',
            'status' => 1,
        ],
        'WRONG_PASSWORD' => [
            'msg'    => 'Wrong password',
            'status' => 2,
        ],
        'RESERVED_URLS' => [
            'msg'    => 'Your selected profile url already exists',
            'status' => 3,
        ],

    ];
    public static string   $_USER_NOT_FOUND = 'USER_NOT_FOUND';
    public static string   $_WRONG_PASSWORD = 'WRONG_PASSWORD';
    public static string   $_RESERVED_URLS = 'RESERVED_URLS';


    public static function message($code) {
        if (key_exists($code, self::$_MESSAGES)) {
            return self::$_MESSAGES[$code]['msg'];
        }
        return null;
    }
    public static function status($code) {
        if (key_exists($code, self::$_MESSAGES)) {
            return self::$_MESSAGES[$code]['status'];
        }
        return null;
    }

    public static function error($code, $fields = null, $message = null, $status = null) {
        $error = ['error' => $code, 'message' => ($message) ? $message : Errors::message($code), 'status' => $status];
        if ($fields)
            $error['fields'] = $fields;
        return $error;
    }

    public static function exception($code, $message = null, $status = null) {
        return ['error' => $code, 'message' => ($message) ? $message : Errors::message($code), 'status' => ($status) ? $status : Errors::status($code)];
    }
}
