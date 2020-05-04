<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes , CascadeSoftDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'contents';

    protected $cascadeDeletes = ['answers' , 'comments'];
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class , null , 'content_id' , 'user_id');
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

    public function answers()
    {
        return $this->hasMany(Answer::class , 'content_id' , '_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }
}
