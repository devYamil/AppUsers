<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * Table Name
     */
    protected $table = 'states';
    /**
     * Fillable State Table
     */
    protected $fillable = [
        'id',
        'id_country',
        'name_state',
    ];
    /**
     * Get Cities for States
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
