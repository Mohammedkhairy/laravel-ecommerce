<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\Traits\TraitHelperMethods;
use App\Http\Requests\Api\Users\loginRequest;
use App\Http\Requests\BackEnd\Users\usersStoreRequest;
use App\Http\Requests\BackEnd\Users\usersUpdateRequest;
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
        $user->update($data);
        return $this->successJson(new $resource($user));
    }

    public function register(usersStoreRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $this->successJson($user);
    }

    public function login(loginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            $user->token = $this->generateToken($credentials);
            return $this->successJson($user);
        }
        return $this->failToLoginJson();

    }

    
    public function refresh()
    {
        return $this->refreshToken();
    }

    public function logout()
    {
        return $this->invalidateToken();
    }
}
