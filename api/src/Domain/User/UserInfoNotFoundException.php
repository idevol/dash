<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\DomainException\DomainRecordNotFoundException;

class UserInfoNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The user information you requested does not exist.';
}
