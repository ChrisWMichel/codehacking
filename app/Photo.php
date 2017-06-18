<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['path'];

    protected $imagePath= '/images/';

    public function getPathAttribute($value){
      return $this->imagePath . $value;
    }
}
