<?php

declare(strict_types=1);

namespace Tests\Domain\User;

use App\Domain\User\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public static function userProvider(): array
    {
        return [
            [1, 'bill.gates', '$4y$32$Ny/iLjvqsoUIG50x8xr2cQKh0Dtr7xTszMjeJPAyaN9IZPleLl2O.'],
            [2, 'steve.jobs', '$Rj$86$5F/rPnMFqOKPtmH9vVHMePFlKAUkHaL3C344XEKbWn5IfQTrYIWY.'],
            [3, 'mark.zuckerberg', '$DB$39$K5/Us1ifa3Tvf4URUFjGYokf24GIkWnpKJbsFM3TWATLIfV3EYY3.'],
            [4, 'evan.spiegel', '$I6$48$Nh/eQO2edqEjundORoxFuUzn81VVlbj9GvZEvoeL4BrFIBS4nN6M.'],
            [5, 'jack.dorsey', '$cq$95$SV/YMLU9hh2hRGTKf92CsKFTR3NcDCGnne02Zz6drREZC0HMSkq5.'],
        ];
    }

    /**
     * @dataProvider userProvider
     * @param int    $id
     * @param string $username
     * @param string $password
     */
    public function testGetters(int $id, string $username, string $password)
    {
        $user = new User($username, $password, $id);

        $this->assertEquals($id, $user->getId());
        $this->assertEquals($username, $user->getUsername());
        $this->assertEquals($password, $user->getPassword());
    }

    /**
     * @dataProvider userProvider
     * @param int    $id
     * @param string $username
     * @param string $password
     */
    public function testJsonSerialize(int $id, string $username, string $password)
    {
        $user = new User($username, $password, $id);

        $expectedPayload = json_encode([
            'id' => $id,
            'username' => $username,
            'password' => $password,
        ]);

        $this->assertEquals($expectedPayload, json_encode($user));
    }
}
