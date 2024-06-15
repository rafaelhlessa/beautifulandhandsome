<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendence extends Model
{
    use HasFactory;

    protected $fillable = [
        'time',
        'work_shift_id',
        'user_id',
    ];
}
