<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Comments\commentRequest;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Models\Comment;
use Illuminate\Support\Facades\URL;

class CommentsController extends BackEndController
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    protected function filters($rows)
    {
        $conditions = [];
        $availableFilter = ['comment'];
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
    public function store(commentRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $row = $this->model->create($data);
        return redirect()->to(URL::previous() . "#comments");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(commentRequest $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $data = $request->all();
        $row->update($data);
        return redirect()->to(URL::previous() . "#comments");

    }

    public function destroy($id)
    {
        $row = $this->model::findOrFail($id);
        $row->delete();
        return redirect()->to(URL::previous() . "#comments");
    }
}
