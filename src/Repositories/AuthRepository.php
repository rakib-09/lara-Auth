<?php
/**
 * Created by PhpStorm.
 * User: jouleslabs
 * Date: 28/12/18
 * Time: 1:21 PM
 */
namespace App\Repositories;

use App\User;

class AuthRepository extends Repository
{
    protected function setModel(): string
    {
        // TODO: Implement setModel() method.
        return User::class;
    }

}
