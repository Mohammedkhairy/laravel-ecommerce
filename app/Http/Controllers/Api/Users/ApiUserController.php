<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\Traits\TraitHelperMethods;
use App\Http\Controllers\Controller;
use App\Models\User;

class ApiUserController extends Controller
{

    const MODEL = User::class;

    use TraitHelperMethods;


}
