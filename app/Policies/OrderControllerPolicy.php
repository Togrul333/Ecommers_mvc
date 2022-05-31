<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrderControllerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function isNotFexri(?User $user)
    {
        if ($user && $user->roles->contains('name','Fexri')) exit('Uzun saclara olmaz !!');

        if ($user && $user->roles->contains('name','admin'))
        {
                return Response::allow('Sene olar');
        }
        return Response::deny('Fexri olma ehtimalin var',403);
    }
}
