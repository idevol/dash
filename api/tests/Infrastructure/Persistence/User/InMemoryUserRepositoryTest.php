<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use Tests\TestCase;
use Psr\Log\LoggerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class InMemoryUserRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $app = $this->getAppInstance();
        $container = $app->getContainer();
        $logger = $container->get(LoggerInterface::class);
        $capsule = $container->get(Capsule::class);

        $user = new User('bill.gates', '$4y$32$Ny/iLjvqsoUIG50x8xr2cQKh0Dtr7xTszMjeJPAyaN9IZPleLl2O.', 1);

        $userRepository = new InMemoryUserRepository($logger, $capsule, [1 => $user]);

        $this->assertEquals([$user], $userRepository->findAll());
    }

    public function testFindAllUsersByDefault()
    {
        $app = $this->getAppInstance();
        $container = $app->getContainer();
        $logger = $container->get(LoggerInterface::class);
        $capsule = $container->get(Capsule::class);

        $users = [
            1 => new User('bill.gates', '$4y$32$Ny/iLjvqsoUIG50x8xr2cQKh0Dtr7xTszMjeJPAyaN9IZPleLl2O.', 1),
            2 => new User('steve.jobs', '$Rj$86$5F/rPnMFqOKPtmH9vVHMePFlKAUkHaL3C344XEKbWn5IfQTrYIWY.', 2),
            3 => new User('mark.zuckerberg', '$DB$39$K5/Us1ifa3Tvf4URUFjGYokf24GIkWnpKJbsFM3TWATLIfV3EYY3.', 3),
            4 => new User('evan.spiegel', '$I6$48$Nh/eQO2edqEjundORoxFuUzn81VVlbj9GvZEvoeL4BrFIBS4nN6M.', 4),
            5 => new User('jack.dorsey', '$cq$95$SV/YMLU9hh2hRGTKf92CsKFTR3NcDCGnne02Zz6drREZC0HMSkq5.', 5),
        ];

        $userRepository = new InMemoryUserRepository($logger, $capsule);

        $this->assertEquals(array_values($users), $userRepository->findAll());
    }

    public function testFindUserOfId()
    {
        $app = $this->getAppInstance();
        $container = $app->getContainer();
        $logger = $container->get(LoggerInterface::class);
        $capsule = $container->get(Capsule::class);

        $user = new User('bill.gates', '$4y$32$Ny/iLjvqsoUIG50x8xr2cQKh0Dtr7xTszMjeJPAyaN9IZPleLl2O.', 1);

        $userRepository = new InMemoryUserRepository($logger, $capsule, [1 => $user]);

        $this->assertEquals($user, $userRepository->findUserOfId(1));
    }

    public function testFindUserOfIdThrowsNotFoundException()
    {
        $app = $this->getAppInstance();
        $container = $app->getContainer();
        $logger = $container->get(LoggerInterface::class);
        $capsule = $container->get(Capsule::class);

        $userRepository = new InMemoryUserRepository($logger, $capsule, []);
        $this->expectException(UserNotFoundException::class);
        $userRepository->findUserOfId(1);
    }
}
