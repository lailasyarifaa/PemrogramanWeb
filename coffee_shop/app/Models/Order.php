<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['coffee_form_id', 'quantity', 'total_price'];

    // Relasi ke model CoffeeForm
    public function coffeeForm()
    {
        return $this->belongsTo(CoffeeForm::class);
    }
}
