<?php

declare(strict_types=1);

use App\Domain\Secure\DataEncryptionRepository;
use App\Infrastructure\Secure\DataEncryption;
use App\Domain\Secure\HashRepository;
use App\Infrastructure\Secure\Hash;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        DataEncryptionRepository::class => \DI\autowire(DataEncryption::class),
        HashRepository::class => \DI\autowire(Hash::class),
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
    ]);
};
