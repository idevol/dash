<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\DomainException\DomainRecordNotFoundException;

class UserNotDeleteException extends DomainRecordNotFoundException
{
    public $message = 'Unable to delete user.';
}
