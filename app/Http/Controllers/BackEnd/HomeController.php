<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;

class HomeController extends BackEndController
{
    
    public function index(){
        return View('backend.home');
    }
}
