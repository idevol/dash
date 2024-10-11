<?php

namespace App\DB\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user', 'password'
    ];

    protected $dateFormat = 'U';
}
