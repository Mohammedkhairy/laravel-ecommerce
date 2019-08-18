<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Requests\BackEnd\Pages\pageRequest;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Models\Page;

class PagesController extends BackEndController
{

    public function __construct(Page $model)
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
    public function store(pageRequest $request)
    {
        $data = $request->all();
        $row = $this->model->create($data);
        return redirect()->route('pages.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(pageRequest $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $data = $request->all();
        $row->update($data);
        return redirect()->back();
    }
}