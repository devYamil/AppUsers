<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    /**
     * Table Name
     */
    protected $table = 'countries';
    /**
     * Fillable Country Table
     */
    protected $fillable = [
        'id',
        'name_country',
    ];

    /**
     * Get States for the Country
     */
    public function states()
    {
        return $this->hasMany(State::class);
    }
}
