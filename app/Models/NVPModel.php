<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class NVPModel extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $collection = 'nvps';
    protected $fillable = ['key', 'value'];
}