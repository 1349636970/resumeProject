<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resume extends Model
{
    protected $table = "resume";
    protected $primaryKey = "id";
    public $timestamp = true;
    protected $dateFormat = "U";
}
