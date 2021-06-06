<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class NVPModel extends Model
{
    use HasFactory;

    protected $collection = 'nvps';
    protected $fillable = ['key', 'value'];
}
