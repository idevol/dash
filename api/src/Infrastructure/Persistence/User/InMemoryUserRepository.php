<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Log\LoggerInterface;

class InMemoryUserRepository implements UserRepository
{

    /**
     * @var Capsule
     */
    protected Capsule $capsule;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var User[]
     */
    private array $users;

    /**
     * @param LoggerInterface $logger
     * @param Capsule $capsule
     * @param User[]|null $users
     */
    public function __construct(LoggerInterface $logger, Capsule $capsule, array $users = null)
    {
        $this->capsule = $capsule;
        $this->logger = $logger;
        $this->users = $users ?? [
            1 => new User(1, 'bill.gates', 'Bill', 'Gates'),
            2 => new User(2, 'steve.jobs', 'Steve', 'Jobs'),
            3 => new User(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'),
            4 => new User(4, 'evan.spiegel', 'Evan', 'Spiegel'),
            5 => new User(5, 'jack.dorsey', 'Jack', 'Dorsey'),
        ];
        $this->logger->info('InMemoryUserRepository constructed');
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->users);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }
}
