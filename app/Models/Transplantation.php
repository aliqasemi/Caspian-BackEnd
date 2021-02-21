<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transplantation extends Model
{
    use HasFactory;

    public function getTable(): string
    {
        return 'transplantation';
    }

    protected $fillable = ['name', 'category'];

    public function portfolio(){
        $this->hasMany(Portfolio::class);
    }


}
