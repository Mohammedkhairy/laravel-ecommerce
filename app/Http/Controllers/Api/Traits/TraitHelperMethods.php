<?php

namespace App\Http\Controllers\Api\Traits;

trait TraitHelperMethods
{

    public function index()
    {
        $model = self::MODEL;
        $data = $model::get();
        return $this->successJson($data);
    }

    protected function successJson($data)
    {
        return response()->json($data, 200);
    }
}
