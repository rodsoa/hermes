<?php

namespace Hermes\Policies;

use Hermes\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function list() {}
                
    public function update() {}
        
    public function store() {}
}
