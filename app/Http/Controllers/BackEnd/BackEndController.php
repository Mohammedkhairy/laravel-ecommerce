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
        $modelName = $this->getViewFolderNamePlural($this->model);
        $rows = $this->model;
        $rows = $this->filters($rows);
        ${$this->getViewFolderNamePlural($this->model)} = $rows->paginate(10);
        return view('backend.' . $modelName . '.index', compact($modelName));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.' . $this->getViewFolderNamePlural($this->model) . '.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelName = $this->getViewFolderNamePlural($this->model);
        ${$this->getViewFolderNameSingle($this->model)} = $this->model::findOrFail($id);
        return view('backend.' . $modelName . '.edit', compact($this->getViewFolderNameSingle($this->model)));

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
