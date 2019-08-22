<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\BackEnd\BackEndController;
use App\Http\Requests\BackEnd\Videos\videoRequest;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\Video;
use Storage;

class VideosController extends BackEndController
{

    public function __construct(Video $model)
    {
        parent::__construct($model);
    }

    protected function with()
    {
        return ['user', 'category'];
    }

    protected function delete_files()
    {
        return ['image'];
    }
    
    protected function delete_relation()
    {
        return ['skills', 'tags'];
    }

    protected function append()
    {
        //return in general
        $array = [
            'categories' => Category::get(),
            'skills' => Skill::get(),
            'tags' => Tag::get(),
            'selectedSkills' => [],
            'selectedTags' => [],
            'comments' => []
        ];

        //return if in edit only
        if (request()->route()->parameter('video')) {
            $array['selectedSkills'] = $this->model->find(request()->route()->parameter('video'))
                ->skills()->pluck('skills.id')->toArray();
       
            $array['selectedTags'] = $this->model->find(request()->route()->parameter('video'))
                ->tags()->pluck('tags.id')->toArray();

            $array['comments'] = $this->model->find(request()->route()->parameter('video'))
                ->comments()->with('user')->get();
        }
        return $array;
    }

    public function store(videoRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['image'] = $request->image->store('/video');
        $row = $this->model->create($data);
        $this->tagsSkillSync($data, $row);
        return redirect()->route('videos.index');
    }

    public function update(videoRequest $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $data = $request->all();
        if (!empty($data['image'])) {
            Storage::delete($row->image);
            $data['image'] = $request->image->store('/video');
        }
        $row->update($data);
        $this->tagsSkillSync($data, $row);
        return redirect()->back();
    }

    protected function tagsSkillSync($data, $row)
    {
        if (isset($data['skills']) && !empty($data['skills'])) {
            $row->skills()->sync($data['skills']);
        }

        if (isset($data['tags']) && !empty($data['tags'])) {
            $row->tags()->sync($data['tags']);
        }
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
}
