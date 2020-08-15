<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table="classes";
    protected $primaryKey='c_id';
    public $timestamps = false;
    protected $guarded = [];//黑名单
}
