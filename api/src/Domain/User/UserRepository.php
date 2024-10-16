<?php

declare(strict_types=1);

namespace App\Domain\User;

use phpDocumentor\Reflection\Types\Boolean;

interface UserRepository
{
    /**
     * @param string $username
     * @param string $password
     * @return UserRepository
     */
    public function setUser(string $username, string $password): UserRepository;

    /**
     * @param string $firstName
     * @param string $middleName
     * @param string $lastName
     * @param string $email
     * @return UserRepository
     */
    public function setUserInfo(string $firstName, string $middleName, string $lastName, string $email): UserRepository;

    /**
     * @return User
     * @throws UserNotSetException
     * @throws UserNotSaveException
     * @throws UserInfoNotSaveException
     */
    public function save(): User;

    /**
     * @return void
     * @throws UserNotDeleteException
     */

    public function delete(): void;

    /**
     * @return bool
     */
    public function login(): bool;

    /**
     * @return UserInfo[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): User;

    /**
     * @param string $email
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserByEmail(string $email): User;

    /**
     * @param string $username
     * @param string $password
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserByUsernameAndPassword(string $username, string $password): User;

    /**
     * @return UserInfo
     * @throws UserInfoNotFoundException
     */
    public function getUserInfo(): UserInfo;
}
