<?php
namespace App\Db\Events;

use App\Db\Models\Pincode;

class PincodeDeleting
{
    public function __construct(Pincode $Pincode)
    {
        $Pincode->validated = 1;
        $Pincode->update();
    }

}
