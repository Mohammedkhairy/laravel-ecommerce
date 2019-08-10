<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Http\Request;

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

    protected function successJson($data)
    {
        return response()->json($data, 200);
    }

    protected function failJson()
    {
        return response()->json(['message' => "Not Found"], 404);
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
