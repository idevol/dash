<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserInfo;
use App\Domain\User\UserInfoNotSaveException;
use App\Domain\User\UserNotDeleteException;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserNotSetException;
use App\Domain\User\UserNotSaveException;
use App\Domain\User\UserRepository;
use App\Db\Models\User as UserModel;
use App\Db\Models\UserInfo as UserInfoModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Infrastructure\Secure\Hash;
use Psr\Log\LoggerInterface;
use Throwable;

class InMemoryUserRepository implements UserRepository
{
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var Capsule
     */
    protected Capsule $capsule;

    /**
     * @var User[]
     */
    private array $users;

    /**
     * @var ?User
     */
    private ?User $user;

    /**
     * @var ?UserInfo
     */
    private ?UserInfo $userInfo;

    /**
     * @param LoggerInterface $logger
     * @param Capsule $capsule
     * @param User[]|null $users
     */
    public function __construct(LoggerInterface $logger, Capsule $capsule, array $users = null)
    {
        $this->logger = $logger;
        $this->capsule = $capsule;
        $this->users = $users ?? [
            1 => new User('bill.gates', '$4y$32$Ny/iLjvqsoUIG50x8xr2cQKh0Dtr7xTszMjeJPAyaN9IZPleLl2O.', 1),
            2 => new User('steve.jobs', '$Rj$86$5F/rPnMFqOKPtmH9vVHMePFlKAUkHaL3C344XEKbWn5IfQTrYIWY.', 2),
            3 => new User('mark.zuckerberg', '$DB$39$K5/Us1ifa3Tvf4URUFjGYokf24GIkWnpKJbsFM3TWATLIfV3EYY3.', 3),
            4 => new User('evan.spiegel', '$I6$48$Nh/eQO2edqEjundORoxFuUzn81VVlbj9GvZEvoeL4BrFIBS4nN6M.', 4),
            5 => new User('jack.dorsey', '$cq$95$SV/YMLU9hh2hRGTKf92CsKFTR3NcDCGnne02Zz6drREZC0HMSkq5.', 5),
        ];
        $this->logger->info('InMemoryUserRepository constructed');
    }

    public function setUser(string $username, string $password): UserRepository
    {
        $this->user = new User($username, $password);
        $this->logger->info('New user is set');
        return $this;
    }

    public function setUserInfo(string $firstName, string $middleName, string $lastName, string $email): UserRepository
    {
        $this->userInfo = new UserInfo($firstName, $middleName, $lastName, $email);
        $this->logger->info('New user info is set');
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function save(): User
    {
        if (null === $this->user || empty($this->user->getUsername()) || empty($this->user->getPassword())) {
            $this->logger->error('User or password is null');
            throw new UserNotSetException();
        }
        try {
            $userNew = UserModel::firstOrNew([
                'username' => $this->user->getUsername()
            ]);
            if (!$userNew->exists) {
                $passwordHash = new Hash($this->user->getPassword());
                $userNew->password = $passwordHash->hashPassword();
                $userNew->save();
            }
        } catch (Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new UserNotSaveException();
        }
        if (isset($this->userInfo)) {
            if (empty($this->userInfo->getEmail())) {
                $this->logger->error('UserInfo or email is null');
                throw new UserInfoNotSaveException();
            }
            try {
                $userInfoNew = UserInfoModel::firstOrNew([
                    'email' => $this->userInfo->getEmail(),
                ]);
                if ($userInfoNew->exists) {
                    $this->logger->info('User email exists');
                } else {
                    $userInfoNew->user_id = $userNew->id;
                    $userInfoNew->first_name = $this->userInfo->getFirstName();
                    $userInfoNew->middle_name = $this->userInfo->getMiddleName();
                    $userInfoNew->last_name = $this->userInfo->getLastName();
                    $userInfoNew->email = $this->userInfo->getEmail();
                    $userInfoNew->save();
                }
            } catch (Throwable $e) {
                $this->logger->error($e->getMessage());
                throw new UserInfoNotSaveException();
            }
            $this->userInfo = new UserInfo(
                $userInfoNew->first_name,
                $userInfoNew->middle_name,
                $userInfoNew->last_name,
                $userInfoNew->email,
                $userInfoNew->user_id,
                $userInfoNew->id
            );
        }
        return new User($userNew->username, $userNew->password, $userNew->id);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(): void
    {
        if (null === $this->user) {
            throw new UserNotDeleteException();
        }
        try {
            $this->capsule->
            table('users_info')->
            where('user_id', '=', $this->user->getId())->
            delete();
        } catch (Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new UserNotDeleteException();
        }
        try {
            $this->capsule->
            table('users')->
            delete($this->user->getId());
            $this->logger->info('User deleted');
        } catch (Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new UserNotDeleteException();
        }
    }

    public function login(): bool
    {
        $userModel = UserModel::where('username', $this->user->getUsername())->get();
        if (!$userModel->isEmpty()){
            $firstUser = $userModel->first();
            $passwordValidate = new Hash($this->user->getPassword(), $firstUser->password);
            return $passwordValidate->validatePassword();
        }
        return false;
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

    public function findUserByEmail(string $email): User
    {
        // TODO: Implement findUserByEmail() method.
        return new User( 'bill.gates', '$4y$32$Ny/iLjvqsoUIG50x8xr2cQKh0Dtr7xTszMjeJPAyaN9IZPleLl2O.', 1);
    }

    public function findUserByUsernameAndPassword(string $username, string $password): User
    {
        // TODO: Implement findUserByUsernameAndPassword() method.
        return new User('bill.gates', '$4y$32$Ny/iLjvqsoUIG50x8xr2cQKh0Dtr7xTszMjeJPAyaN9IZPleLl2O.', 1);
    }

    public function getUserInfo(): UserInfo
    {
        // TODO: Implement getUserInfo() method.
        return new UserInfo('Bill', 'Gates', 'Steve', 'bill@microsoft.com', 1, 1);
    }
}
