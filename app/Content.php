<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;
    use HybridRelations;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'contents';


    public function users()
    {
        return $this->belongsToMany(User::class , 'user_content' , 'content_id' , 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
