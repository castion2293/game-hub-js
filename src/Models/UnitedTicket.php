<?php

namespace SuperStation\Gamehub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Arr;

class UnitedTicket extends Model
{
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    protected $guarded = [];

    /**
     * REPLACE INTO 支援 (MySQL 限定)
     *
     * @param $data
     * @return mixed
     */
    public static function replace($data)
    {
        $instance = new static;
        return $instance->replaceInto($data);
    }

    /**
     * REPLACE INTO 支援 (MySQL 限定)
     *
     * @param $data
     * @return bool
     */
    private function replaceInto($data)
    {
        $database = $this->getConnection();

        foreach ($data as $item) {
            $build = $this->newBaseQueryBuilder();
            $build->from($this->getTable());
            $sql = $build->getGrammar()->compileInsert($build, $item);
            $sql = str_replace('insert into', 'replace into', $sql);

            $item = array_values(array_filter(Arr::flatten($item, 1), function ($item) {
                return !$item instanceof Expression;
            }));

            $database->statement($sql, $item);
        }

        return true;
    }
}