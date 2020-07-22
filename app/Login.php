<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table="p_user";
    protected $primaryKey="user_id";
    public $timestamps = false;
    protected $guarded = [];//黑名单
}
