<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Users\usersStoreRequest;
use App\Http\Requests\BackEnd\Users\usersUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends BackEndController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    protected function filters($rows)
    {
        $conditions = [];
        $availableFilter = ['name', 'email', 'created_at'];
        foreach (request()->toArray() as $key => $value) {
            if (in_array($key, $availableFilter)) {
                $conditions[$key] = $value;
            }
        }
        return $rows = $rows->where($conditions);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(usersStoreRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $users = $this->model->create($data);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(usersUpdateRequest $request, $id)
    {
        $user = $this->model->findOrFail($id);
        $data = $request->all();
        if ($request->has($request->password) && !empty($request->password)) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->back();
    }
}
