<?php

namespace App\Db\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Db\Events\PincodeDeleting;

class Pincode extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ip_address', 'pincode', 'token', 'validated'
    ];

    protected $dispatchesEvents = [
        'deleting' => PincodeDeleting::class
    ];
}
