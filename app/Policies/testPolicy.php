<?php

namespace App\Policies;

use App\BlogUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class testPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function test(){

    }
}
