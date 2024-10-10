<?php
namespace DB\Events;

use DB\Models\Pincode;

class PincodeDeleting
{
    public function __construct(Pincode $Pincode)
    {
        $Pincode->validated = 1;
        $Pincode->update();
    }

}
