<?php

namespace App\Consts;

class PostStatus
{
    public const DRAFT = 0;
    public const PUBLISH = 1;

    static public $body = [
        self::DRAFT     => '下書き',
        self::PUBLISH   => '公開',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public static function toArray()
    {
        return self::$body;
    }

    public static function valueOf($key)
    {
        return self::$body[ $key ] ?? null;
    }
}