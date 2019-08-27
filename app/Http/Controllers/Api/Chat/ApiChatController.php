<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\Traits\TraitHelperMethods;
use App\Http\Resources\chatResource;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;

class ApiChatController extends ApiController
{

    const MODEL = Chat::class;
    const RESOURCE = chatResource::class;

    use TraitHelperMethods;


    public function store(Request $request)
    {
        $chat = $request->all();
        $chat['read'] = 1;
        $chat = Chat::create($chat);
        
    }
}
