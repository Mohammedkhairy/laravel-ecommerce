<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends BackEndController
{
    
    public function __construct(User $model){
        parent::__construct($model);
    }
    public function index(){
        return View('backend.home');
    }
}
