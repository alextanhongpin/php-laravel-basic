<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    // $fillable ensures this fields are make required
    // during create and update.
    protected $fillable = ['make', 'model', 'year'];
}
