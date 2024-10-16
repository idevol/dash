<?php

declare(strict_types=1);

namespace App\Domain\Secure;

interface HashRepository
{
    /**
     * @return string
     */
    public function hashPassword(): string;

    /**
     * @return bool
     */
    public function validatePassword(): bool;
}
