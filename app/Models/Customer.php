<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name','email','phone','company','address'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
