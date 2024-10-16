<?php

namespace App\Db\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'username', 'password'
    ];

    protected $dateFormat = 'U';
}
