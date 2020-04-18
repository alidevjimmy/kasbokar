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

    public function scopeSearch($query , $input) 
    {
        if (isset($input['Nivel']) && !empty($input['Nivel'])) {
            $query->where('category_id' , (integer)$input['Nivel']);
        }
        if (isset($input['type']) && !empty($input['type'])) {
            $query->where('type' , $input['type']);
        }
        if (isset($input['search']) && !empty($input['search'])) {
            $query->where('title' , 'LIKE' , '%'.$input['search'].'%');
        }
    }
}
