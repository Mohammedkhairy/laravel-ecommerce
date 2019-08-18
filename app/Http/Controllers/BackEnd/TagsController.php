<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Tags\tagRequest;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Models\Tag;

class TagsController extends BackEndController
{
    public function __construct(Tag $model)
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
    public function store(tagRequest $request)
    {
        $data = $request->all();
        $row = $this->model->create($data);
        return redirect()->route('tags.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(tagRequest $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $data = $request->all();
        $row->update($data);
        return redirect()->back();
    }
}
