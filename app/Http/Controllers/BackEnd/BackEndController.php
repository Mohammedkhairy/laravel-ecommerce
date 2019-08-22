<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Storage;

class BackEndController extends Controller
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getViewFolderNamePlural($model)
    {
        return str_plural(strtolower(class_basename($model)));
    }

    public function getViewFolderNameSingle($model)
    {
        return strtolower(class_basename($model));
    }

    public function index()
    {
        $routeName = $title = $modelName = $this->getViewFolderNamePlural($this->model);
        $Model_name = $this->getViewFolderNameSingle($this->model);
        $page_title = $title . ' control';
        $tableDescription = "Here You Can Add / Edit / Delete " . $title;
        $rows = $this->filters($this->model);
        $with = $this->with();
        if (!empty($with)) {
            $rows = $rows->with($with);
        }
        $rows = $rows->paginate(10);
        return view('backend.' . $modelName . '.index',
            compact('rows', 'routeName', 'title', 'page_title', 'tableDescription', 'Model_name')
        );
    }

    public function create()
    {
        $folderName = $routeName = $title = $this->getViewFolderNamePlural($this->model);
        $Model_name = $this->getViewFolderNameSingle($this->model);
        $page_title = 'create ' . $title;
        $button_name = " Add " . $Model_name;
        $tableDescription = "Here You Can  Create " . $title;
        $append = $this->append();
        return view('backend.' . $folderName . '.create',
            compact('folderName', 'title', 'routeName', 'page_title', 'tableDescription', 'Model_name', 'button_name')
        )->with($append);
    }

    public function edit($id)
    {
        $folderName = $routeName = $title = $this->getViewFolderNamePlural($this->model);
        $Model_name = $this->getViewFolderNameSingle($this->model);
        $page_title = 'edit ' . $title;
        $button_name = " update " . $Model_name;
        $tableDescription = "Here You Can  Edit " . $title;
        $row = $this->model::findOrFail($id);
        $append = $this->append();
        return view('backend.' . $folderName . '.edit',
            compact('folderName', 'row', 'routeName', 'button_name', 'title', 'page_title', 'tableDescription', 'Model_name')
        )->with($append);

    }

    public function destroy($id)
    {
        $row = $this->model::findOrFail($id);

        if (isset($row->image) && !empty($row->image)) {
        }

        $deleteFiles = $this->delete_files();
        if (!empty($deleteFiles)) {
            foreach ($deleteFiles as $file) {
                if (!empty($row->$file)) {
                    Storage::delete($row->$file);
                }
            }
        }

        $relations = $this->delete_relation();
        if (!empty($relations)) {
            foreach ($relations as $relation) {
                $row->$relation()->detach();
            }
        }

        $row->delete();

        return redirect()->back();

    }

    protected function filters($rows)
    {
        return $rows;
    }

    protected function delete_files()
    {
        return [];
    }

    protected function delete_relation()
    {
        return [];
    }

    protected function with()
    {
        return [];
    }

    protected function append()
    {
        return [];
    }
}
