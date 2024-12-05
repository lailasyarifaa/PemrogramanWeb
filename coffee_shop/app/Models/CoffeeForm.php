<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeForm extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'number', 'guests'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}

