<?php

namespace SuperStation\Gamehub\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use SuperStation\Gamehub\Contracts\RawTicketContract;

abstract class RawTicket extends Model implements RawTicketContract
{
    protected $connection = 'mongodb';

    protected $guarded = [];

    protected $appends = ['uuid', 'md5_hash'];

    /**
     * @param array $uniqueFieldsData
     * @return string
     */
    public function uniqueToUuid($uniqueFieldsData = [])
    {
        sort($uniqueFieldsData);
        $uniqueDataString = join('-', $uniqueFieldsData);
        return Uuid::uuid3(Uuid::NAMESPACE_DNS, $uniqueDataString . '@' . class_basename($this));
    }

    /**
     * 把所有的原生注單屬性做md5 hash
     *
     * @param array $attributes
     * @return string
     */
    public function md5HashAttributes(array $attributes)
    {
        return md5(json_encode($attributes));
    }
}