<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'country',
        'state',
        'city',
        'latitude',
        'longitude',
        'browser',
        'os',
        'device',
        'traffic_source',
        'link_id'
    ];
}
