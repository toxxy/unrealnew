<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actuators extends Model
{
    use HasFactory;
    protected $fillable = ['unit', 'device','action','status'];
}
