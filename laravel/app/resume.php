<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resume extends Model
{
    protected $table = "resume";
    protected $primaryKey = "id";
    public $timestamp = true;
    public function getDateFormat() {
        return time();
    }
    public function asDateTime($val) {
        return $val;
    }
}
