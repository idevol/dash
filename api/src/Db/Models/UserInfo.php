<?php

namespace App\Db\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'email'
    ];

    protected $dateFormat = 'U';
}
