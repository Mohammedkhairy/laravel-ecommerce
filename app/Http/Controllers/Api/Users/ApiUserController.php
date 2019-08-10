<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\Traits\TraitHelperMethods;
use App\Http\Requests\Api\Users\loginRequest;
use App\Http\Requests\BackEnd\Users\usersStoreRequest;
use App\Http\Requests\BackEnd\Users\usersUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends ApiController
{

    const MODEL = User::class;
    const RESOURCE = userResource::class;

    use TraitHelperMethods;

    public function update(usersUpdateRequest $request, $id)
    {
        $model = self::MODEL;
        $resource = self::RESOURCE;
        $user = $model::find($id);
        $data = $request->all();
        if ($request->has($request->password) && !empty($request->password)) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $data['token'] = $model::generateApiToken();
        $user->update($data);
        return $this->successJson(new $resource($user));
    }

    function register(usersStoreRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['token'] = User::generateApiToken();
        $user = User::create($data);
        return $this->successJson($user);
    }

    function login(loginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            $user->token = User::generateApiToken();
            $user->update(['token' => $user->token]);
            return $this->successJson($user);
        }
        return $this->failToLoginJson();

    }

}
