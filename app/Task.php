<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function categories() {
        return $this->belongsToMany('App\Category', 'App\TaskCategory');
    }
}
