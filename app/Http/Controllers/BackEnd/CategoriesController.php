<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Category\categoryRequest;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Models\Category;

class CategoriesController extends BackEndController
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    protected function filters($rows)
    {
        $conditions = [];
        $availableFilter = ['name'];
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
    public function store(categoryRequest $request)
    {
        $data = $request->all();
        $row = $this->model->create($data);
        return redirect()->route('categories.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(categoryRequest $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $data = $request->all();
        $row->update($data);
        return redirect()->back();
    }
}
