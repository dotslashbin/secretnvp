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

    protected $collection = 'nvps';
    protected $fillable = ['key', 'value'];
    protected $appends = ['timestamp'];

    /**
     * Dynamically creates a timetamp attribute to add ot the output model
     *
     * @return void
     */
    public function getTimestampAttribute() {
        return (string) $this->attributes['created_at'];
    }   
}