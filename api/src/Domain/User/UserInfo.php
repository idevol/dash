<?php

declare(strict_types=1);

namespace App\Domain\User;

use JsonSerializable;

class UserInfo implements JsonSerializable
{
    private ?int $id;

    private ?int $userId;

    private string $firstName;

    private string $middleName;

    private string $lastName;

    private string $email;

    public function __construct(string $firstName, string $middleName, string $lastName, string $email, ?int $userId = null, ?int $id = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->firstName = ucfirst($firstName);
        $this->middleName = ucfirst($middleName);
        $this->lastName = ucfirst($lastName);
        $this->email = strtolower($email);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'firstName' => $this->firstName,
            'middleName' => $this->middleName,
            'lastName' => $this->lastName,
            'email' => $this->email,
        ];
    }
}
