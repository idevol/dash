<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\DomainException\DomainRecordNotFoundException;

class UserNotSaveException extends DomainRecordNotFoundException
{
    public $message = 'Unable to save user.';
}
