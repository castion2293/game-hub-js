<?php

namespace SuperStation\Gamehub\Traits;

use DateTime;
use DateTimeZone;
use MongoDB\BSON\UTCDateTime;

trait DateTimeTrait
{
    /**
     * 轉換成MongoDB時間格式
     *
     * @param string $dateTime
     * @param DateTimeZone|null $timezone
     * @return UTCDateTime
     * @throws \Exception
     */
    protected function MongoDdDateTime(string $dateTime, string $timezone)
    {
        return new UTCDateTime(new DateTime($dateTime, new DateTimeZone($timezone)));
    }
}