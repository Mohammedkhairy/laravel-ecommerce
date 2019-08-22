<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

trait TraitHelperMethods
{

    public function index()
    {
        $model = self::MODEL;
        $resource = self::RESOURCE;
        $data = $model::get();
        if (empty($data)) {
            return $this->failJson();
        }
        return $this->successJson($resource::collection($data));
    }

    public function show($id)
    {
        $model = self::MODEL;
        $resource = self::RESOURCE;
        $data = $model::find($id);
        if (empty($data)) {
            return $this->failJson();
        }
        return $this->successJson(new $resource($data));
    }

    public function update(Request $request, $id)
    {
        $model = self::MODEL;
        $resource = self::RESOURCE;
        $data = $model::find($id);
        if (empty($data)) {
            return $this->failJson();
        }
        $data->update($request->all());
        return $this->successJson(new $resource($data));
    }

    public function destroy($id)
    {
        $model = self::MODEL;
        $resource = self::RESOURCE;
        $data = $model::find($id);
        if (empty($data)) {
            return $this->failJson();
        }
        $data->delete();
        return $this->successJson(new $resource($data));
    }

    protected function generateToken($credentials)
    {
        $ApiToken = JWTAuth::attempt($credentials);
        return $ApiToken;

    }

    protected function refreshToken()
    {
        $ApiToken = JWTAuth::getToken();
        $ApiToken = JWTAuth::refresh($ApiToken);
        return $this->successJson(['token' => $ApiToken]);

    }

    protected function invalidateToken()
    {
        $ApiToken = JWTAuth::getToken();
        $ApiToken = JWTAuth::invalidate($ApiToken);
        return $this->successJson(['message' => 'Logout Successfully .. ']);

    }

    protected function successJson($data)
    {
        return response()->json($data, 200);
    }

    protected function failJson()
    {
        return response()->json(['message' => "Not Found"], 404);
    }

    protected function processNotDone()
    {
        return response()->json(['message' => "Process not done , please try again."], 422);
    }

    protected function failToLoginJson()
    {
        return response()->json(['message' => "User details incorrect"], 401);
    }

    protected function unAuthorizeJson()
    {
        return response()->json(['message' => "unAuthorize"], 401);
    }
}
