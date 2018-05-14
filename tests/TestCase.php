<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function login($user = null)
    {
        if(!$user){
            $user = User::latest()->first();
        }
        $this->be($user);
    }
}
