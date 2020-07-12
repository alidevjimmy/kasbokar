<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes , CascadeSoftDeletes;
    protected $fillable = ['image' , 'name' , 'level' , 'body'];
    protected $table = 'categories';
    protected $connection = 'pgsql';

    protected $cascadeDeletes = ['contents'];
    protected $dates = ['deleted_at'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
