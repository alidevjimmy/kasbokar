<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Replay extends Model
{
    use SoftDeletes;
    protected $fillable = ['replay' , 'answer_id'];
    protected $table = 'categories';
    protected $connection = 'pgsql';

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
