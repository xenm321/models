<?php

namespace App\Tests\Controller\Api;

use App\Entity\User;
use App\Tests\DataFixtureTestCase;

class UserControllerTest extends DataFixtureTestCase
{
    private $baseUrl = '/api/user';

    public function testCanGetOneUser()
    {
        $user = $this->createEntity(User::class, [
            'username' => 'test',
            'password' => '123',
            'active' => true,
        ]);

        $createdUser = $this->getJson($this->baseUrl.'/'.$user->getId());

        $this->assertEquals($createdUser['username'], $user->getUsername());
        $this->assertEquals($createdUser['active'], $user->isActive());
    }

    public function testCanGetCurrentUser()
    {
        $user = $this->getJson($this->baseUrl.'/current');

        $this->assertEquals($user['username'], 'admin');
    }
}
