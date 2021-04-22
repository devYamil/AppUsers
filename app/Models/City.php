<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * Table Name
     */
    protected $table = 'cities';
    /**
     * Fillable State Table
     */
    protected $fillable = [
        'id',
        'id_state',
        'name_city',
    ];
}
