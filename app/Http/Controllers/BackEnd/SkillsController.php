<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Skills\skillRequest;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Models\Skill;

class SkillsController extends BackEndController
{
    public function __construct(Skill $model)
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
    

    public function store(skillRequest $request)
    {
        $data = $request->all();
        $row = $this->model->create($data);
        return redirect()->route('skills.index');
    }

    
    public function update(skillRequest $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $data = $request->all();
        $row->update($data);
        return redirect()->back();
    }
}
