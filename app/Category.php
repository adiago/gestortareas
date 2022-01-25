<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const PHP = 1;
    const JS = 2;
    const CSS = 3;

    protected $table = 'categories';

    protected $guarded = ['id', 'created_at','updated_at'];
    
    public function tasks() {
        return $this->belongsToMany('App\Task', 'App\TaskCategory');
    }
}
