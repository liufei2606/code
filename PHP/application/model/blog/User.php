<?php

namespace Application\services\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
}
