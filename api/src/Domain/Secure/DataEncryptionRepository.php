<?php

declare(strict_types=1);

namespace App\Domain\Secure;

interface DataEncryptionRepository
{
    /**
     * @return ?string
     */
    public function encrypt(): ?string;

    /**
     * @return ?array
     */
    public function decrypt(): ?array;
}
