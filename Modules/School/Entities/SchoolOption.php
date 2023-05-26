<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'key',
        'value'
    ];

    public static function getOption($school_id, $key, $default)
    {
        return self::where([
            'school_id' => $school_id,
            'key' => $key
        ])->first()->value ?? $default;
    }

    public static function setOption($school_id, $key, $value)
    {
        $opt = self::where([
            'school_id' => $school_id,
            'key' => $key
        ])->first();

        if ($opt) {
            return self::where([
                'school_id' => $school_id,
                'key' => $key
            ])->update(['value' => $value]);
        } else {
            return self::create([
                'school_id' => $school_id,
                'key' => $key,
                'value' => $value
            ]);
        }
    }

    public $timestamps = false;
}