<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekendDays extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
    ];
}
