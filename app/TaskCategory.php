<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model
{
    protected $table = 'task_category';

    protected $guarded = ['id','created_at', 'updated_at'];
}
