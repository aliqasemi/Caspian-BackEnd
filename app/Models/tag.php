<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;

    public function getTable()
    {
        return "tags";
    }

    protected $fillable = ['name', 'user_id', 'tagable_type', 'tagable_id'];

    public function tagable(){
        return $this->morphTo();
    }
}
