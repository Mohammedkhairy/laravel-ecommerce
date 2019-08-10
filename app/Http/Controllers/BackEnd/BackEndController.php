<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;

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
        $title = $this->getViewFolderNamePlural($this->model);
        $Model_name = $this->getViewFolderNameSingle($this->model);
        $page_title = $title . ' Control';
        $tableDescription = "Here You Can Add / Edit / Delete " . $title;
        $modelName = $this->getViewFolderNamePlural($this->model);
        $rows = $this->model;
        $rows = $this->filters($rows);
        ${$this->getViewFolderNamePlural($this->model)} = $rows->paginate(10);
        return view('backend.' . $modelName . '.index', compact($modelName, 'title', 'page_title', 'tableDescription', 'Model_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->getViewFolderNamePlural($this->model);
        $Model_name = $this->getViewFolderNameSingle($this->model);
        $page_title = 'Create ' . $title;
        $button_name = " Add " . $Model_name;
        $tableDescription = "Here You Can  Create " . $title;
        return view('backend.' . $this->getViewFolderNamePlural($this->model) . '.create',
            compact('title', 'page_title', 'tableDescription', 'Model_name', 'button_name')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = $this->getViewFolderNamePlural($this->model);
        $Model_name = $this->getViewFolderNameSingle($this->model);
        $page_title = 'Edit ' . $title;
        $button_name = " update " . $Model_name;
        $tableDescription = "Here You Can  Edit " . $title;
        $modelName = $this->getViewFolderNamePlural($this->model);
        ${$this->getViewFolderNameSingle($this->model)} = $this->model::findOrFail($id);
        return view('backend.' . $modelName . '.edit',
            compact($this->getViewFolderNameSingle($this->model), 'button_name', 'title', 'page_title', 'tableDescription', 'Model_name'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
        return redirect()->back();

    }

    protected function filters($rows)
    {
        return $rows;
    }
}
