<?php

declare(strict_types=1);

namespace App\Infrastructure\Secure;

use App\Domain\Secure\HashRepository;

class Hash implements HashRepository
{
    /**
     * @var string
     */
    private string $password;

    /**
     * @var ?string
     */
    private ?string $hashedPassword;

    public function __construct(string $password, ?string $hashedPassword = null)
    {
        $this->password = $password;
        $this->hashedPassword = $hashedPassword;
    }
    public function hashPassword(): string
    {
        return password_hash($this->password . $_ENV['DASH_SALT'], PASSWORD_BCRYPT, ['cost' => 12]);
    }

    public function validatePassword(): bool
    {
        if ($this->hashedPassword === null){ return false; }
        return password_verify($this->password . $_ENV['DASH_SALT'], $this->hashedPassword);
    }
}