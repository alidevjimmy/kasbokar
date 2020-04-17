<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['image' , 'name' , 'level'];
    protected $table = 'categories';
    protected $connection = 'pgsql';

    public function contents()
    {
        return $this->hasMany(Content::class , '_id');
    }
}
