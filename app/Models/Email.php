<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Email extends Model
{
    /**
     * Table Name
     */
    protected $table = 'emails';
    /**
     * Fillable Email Table
     */
    protected $fillable = [
        'id',
        'id_user',
        'subject',
        'destination',
        'message',
        'status_send_email',
    ];

    public $timestamps = false;

}
